<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\UserRole;
use App\Models\Expense\RequestApproval;
use App\Models\Expense\RequestItem;
use App\Models\Expense\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestApprovalController
{

    public function updateBookKeeper(Request $request, $expenseRequestID)
    {

        try {

            DB::beginTransaction();

            $bookKeeperRoleID = Role::where('name', UserRole::BOOK_KEEPER->value)
                ->pluck('id')
                ->first();

            RequestApproval::updateOrCreate([
                'request_id' => $expenseRequestID,
                'role_id' => $bookKeeperRoleID,
            ],
                [
                    'user_id' => Auth::id(),
                    'status' => RequestApprovalStatus::valueOf($request->input('status'))
                ]
            );

            DB::commit();

            return redirect()->route('request', ['id' => $expenseRequestID]);
        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect()->route('request', ['id' => $expenseRequestID])->withErrors('message', 'Something went wrong');
        }
    }

    public function updateAccountant(Request $request, $expenseRequestID)
    {

        try {

            DB::beginTransaction();

            $bookKeeperRoleID = Role::where('name', UserRole::ACCOUNTANT->value)
                ->pluck('id')
                ->first();

            RequestApproval::updateOrCreate([
                'request_id' => $expenseRequestID,
                'role_id' => $bookKeeperRoleID,
            ],
                [
                    'user_id' => Auth::id(),
                    'status' => RequestApprovalStatus::valueOf($request->input('status'))
                ]
            );

            RequestItem::where('request_id',$expenseRequestID)
            ->where('status', RequestItemStatus::PENDING->name)
                ->update(['status' => RequestItemStatus::valueOf($request->input('status'))]);

            DB::commit();

            return redirect()->route('request', ['id' => $expenseRequestID]);
        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect()->route('request', ['id' => $expenseRequestID])->withErrors('message', 'Something went wrong');
        }
    }

    public function updateFinance(Request $request, $expenseRequestID)
    {

        try {

            DB::beginTransaction();

            $bookKeeperRoleID = Role::where('name', UserRole::FINANCE->value)
                ->pluck('id')
                ->first();

            RequestApproval::updateOrCreate([
                'request_id' => $expenseRequestID,
                'role_id' => $bookKeeperRoleID,
            ],
                [
                    'user_id' => Auth::id(),
                    'status' => RequestApprovalStatus::valueOf($request->input('status'))
                ]
            );

            DB::commit();

            return redirect()->route('request', ['id' => $expenseRequestID]);
        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect()->route('request', ['id' => $expenseRequestID])->withErrors('message', 'Something went wrong');
        }
    }

    public function updateAuditor(Request $request, $expenseRequestID)
    {

        try {

            DB::beginTransaction();

            $bookKeeperRoleID = Role::where('name', UserRole::AUDITOR->value)
                ->pluck('id')
                ->first();

            RequestApproval::updateOrCreate([
                'request_id' => $expenseRequestID,
                'role_id' => $bookKeeperRoleID,
            ],
                [
                    'user_id' => Auth::id(),
                    'status' => RequestApprovalStatus::valueOf($request->input('status'))
                ]
            );

            DB::commit();

            return redirect()->route('request', ['id' => $expenseRequestID]);
        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect()->route('request', ['id' => $expenseRequestID])->withErrors('message', 'Something went wrong');
        }
    }
}
