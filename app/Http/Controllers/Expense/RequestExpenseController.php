<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\RequestExpenseType;
use Illuminate\Http\Request;
use \App\Models\Expense\Request as ExpenseRequest;
use Illuminate\Support\Facades\DB;

class RequestExpenseController
{
    public function updateRequestExpense(Request $request, ExpenseRequest $expenseRequest)
    {
        try {
            DB::beginTransaction();

            RequestExpenseType::where('request_id',$expenseRequest->id)->delete();

            foreach ($request->input('category') as $category ){
                RequestExpenseType::create([
                    'expense_category_id' => $category,
                    'request_id' => $expenseRequest->id
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],500);
        }
    }
}
