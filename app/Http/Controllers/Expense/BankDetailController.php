<?php

namespace App\Http\Controllers\Expense;

use App\Actions\AddRequestLog;
use App\Models\Expense\BankDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankDetailController extends Controller
{
    public function addBankDetails(Request $request)
    {

        $validated = $request->validate([
            'bank_name_id' => 'nullable',
            'bank_code_id' => 'nullable',
            'check_number' => 'nullable',
            'request_id' => 'required',
        ]);

        $requestID = $validated['request_id'];

        try {

            DB::beginTransaction();

            $bankDetail = BankDetail::firstOrNew(['request_id' => $requestID]);

            if (isset($validated['bank_name_id'])) {
                if( ($validated['bank_name_id']) == -1){
                    $bankDetail->bank_name_id = null;
                }else{
                    $bankDetail->bank_name_id = $validated['bank_name_id'];
                }
            }

            if (isset($validated['bank_code_id'])) {
                if( ($validated['bank_code_id']) == -1){
                    $bankDetail->bank_code_id = null;
                }else{
                    $bankDetail->bank_code_id = $validated['bank_code_id'];
                }
            }

            if (isset($validated['check_number'])) {
                $bankDetail->check_number = $validated['check_number'];
            }

            $bankDetail->save();

            DB::commit();

            return response()->json([
                'message' => 'Bank details added successfully!',
                'status' => 200,
            ]);

        }  catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
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
