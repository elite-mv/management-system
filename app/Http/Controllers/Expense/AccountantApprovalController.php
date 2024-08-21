<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Models\Expense\AccountantApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountantApprovalController
{
    public function index(Request $request, $requestID){

        try {

            DB::beginTransaction();

            AccountantApproval::updateOrCreate( ['request_id' => $requestID ],
                [
                    'user_id' => Auth::id(),
                    'status' => RequestApprovalStatus::valueOf($request->input('status'))
                ]
            );

            DB::commit();

            return redirect()->route('request', ['id' => $requestID]);

        }catch (\Exception $exception){

            DB::rollBack();

            return redirect()->route('request', ['id' => $requestID])->withErrors('message', 'Something went wrong');
        }
    }
}
