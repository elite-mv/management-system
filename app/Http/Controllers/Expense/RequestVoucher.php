<?php

namespace App\Http\Controllers\Expense;

use App\Enums\PaymentMethod;
use App\Models\Expense\CheckVoucher;
use App\Models\Expense\Request as ExpenseRequest;
use Illuminate\Support\Facades\DB;

class RequestVoucher
{

    public function generate(ExpenseRequest $expenseRequest)
    {
        try {

            DB::beginTransaction();

            if($expenseRequest->payment_method == PaymentMethod::CHECK){
                if(!$expenseRequest->bankDetails()){
                    throw new \Exception("Bank details not provided");
                }
            }

            CheckVoucher::updateOrCreate(['request_id' => $expenseRequest->id]);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        }catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 200,
            ], 500);
        }
    }
}
