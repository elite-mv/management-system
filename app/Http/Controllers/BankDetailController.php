<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Models\Bank;
use App\Models\BankCode;
use App\Models\BankDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankDetailController extends Controller
{
    public function addBankDetails(Request $request)
    {

        $bankName = $request->input('bankName');
        $bankCode = $request->input('bankNumber');
        $checkNumber = $request->input('checkNumber');
        $requestID = $request->input('requestID');

        try {

            $expenseRequest = \App\Models\Request::where('id', $requestID)
                ->whereIn('payment_method', [
                    PaymentMethod::CHECK->name,
                    PaymentMethod::ONLINE_TRANSFER->name,
                    PaymentMethod::CREDIT_CARD->name,
                    ])
                ->firstOrFail();


            if($expenseRequest->payment_method == PaymentMethod::CREDIT_CARD || $expenseRequest->payment_method == PaymentMethod::ONLINE_TRANSFER){
                if($checkNumber != null && $bankCode != null){
                    throw new \Error('check number and bank code is not need for credit card/online transfer');
                }
            }

            if($expenseRequest->payment_method == PaymentMethod::CHECK){
                BankCode::where('id', $bankCode)
                    ->where('bank_name_id', $bankName)
                    ->firstOrFail();
            }

            DB::beginTransaction();

            $bankDetail = BankDetail::updateOrCreate(['request_id' => $requestID], [
                'bank_name_id' => $bankName,
                'bank_code_id' => $bankCode,
                'check_number' => $checkNumber,
            ]);

            DB::commit();

            return response()->json(['message' => 'Bank details added successfully!']);

        }catch(\Exception $e){
            DB::rollback();
            abort(500);
        }
    }

    public function removeBankDetails($requestID)
    {

        try {

            DB::beginTransaction();

            BankDetail::where('request_id', $requestID)->delete();

            DB::commit();

            return response()->json(['message' => 'Bank details deleted successfully!']);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' =>  $e->getMessage()]);

//            abort(500);
        }
    }
}
