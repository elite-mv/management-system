<?php

namespace App\Http\Controllers\Expense;

use App\Enums\PaymentMethod;
use App\Exceptions\Expense\InvalidBankDetails;
use App\Models\Expense\BankCode;
use App\Models\Expense\BankDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

            $expenseRequest = \App\Models\Expense\Request::where('id', $requestID)
                ->whereIn('payment_method', [
                    PaymentMethod::CHECK->name,
                    PaymentMethod::ONLINE_TRANSFER->name,
                    PaymentMethod::CREDIT_CARD->name,
                ])
                ->first();

            if (!isset($expenseRequest)) {
                throw new InvalidBankDetails('Bank details are not required for the Cash payment method');
            }

            if ($expenseRequest->payment_method == PaymentMethod::CREDIT_CARD || $expenseRequest->payment_method == PaymentMethod::ONLINE_TRANSFER) {
                if (!(empty($checkNumber) && $bankCode == -1)) {
                    throw new InvalidBankDetails('check number and bank code is not need for credit card/online transfer');
                }
            }

            if ($expenseRequest->payment_method == PaymentMethod::CHECK) {

                $valid = BankCode::where('id', $bankCode)
                    ->where('bank_name_id', $bankName)
                    ->first();

                if (!isset($valid)) {
                    throw new InvalidBankDetails('Bank Name and Bank Code does not match!');
                }
            }

            DB::beginTransaction();

            $bankDetail = BankDetail::updateOrCreate(['request_id' => $requestID], [
                'bank_name_id' => $bankName,
                'bank_code_id' => $bankCode == -1 ? null : $bankCode,
                'check_number' => $checkNumber,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Bank details added successfully!',
                'status' => 200,
            ]);

        } catch (InvalidBankDetails $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 400
            ], 400);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong!, please contact developer',
                'status' => 500
            ], 500);
        }
    }

    public function removeBankDetails($requestID)
    {

        try {

            DB::beginTransaction();

            BankDetail::where('request_id', $requestID)->delete();

            DB::commit();

            return response()->json(['message' => 'Bank details deleted successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }
    }
}
