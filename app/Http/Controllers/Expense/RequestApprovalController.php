<?php

namespace App\Http\Controllers\Expense;

use App\Actions\AddRequestLog;
use App\Actions\UpdateRequestApproval;
use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Models\Expense\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestApprovalController
{

    private UpdateRequestApproval $updateRequestApproval;
    private AddRequestLog $addRequestLog;

    public function __construct(UpdateRequestApproval $updateRequestApproval, AddRequestLog $addRequestLog)
    {
        $this->updateRequestApproval = $updateRequestApproval;
        $this->addRequestLog = $addRequestLog;
    }


    public function updateBookKeeper(Request $request, $expenseRequestID)
    {
        try {

//            $data = true;
//
//            if ($data) {
//                throw new \Exception('tae');
//            }

            $roleID = Role::where('name', UserRole::BOOK_KEEPER->value)
                ->pluck('id')
                ->first();

            $status = RequestApprovalStatus::valueOf($request->input('status'));

            $this->updateRequest($status, $roleID, $expenseRequestID);

            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'something went wrong']);
        }
    }

    public function updateAccountant(Request $request, $expenseRequestID)
    {

        try {

            $roleID = Role::where('name', UserRole::ACCOUNTANT->value)
                ->pluck('id')
                ->first();

            $status = RequestApprovalStatus::valueOf($request->input('status'));

            $this->updateRequest($status, $roleID, $expenseRequestID);

            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'something went wrong']);
        }
    }

    public function updateFinance(Request $request, $expenseRequestID)
    {

        try {

            $roleID = Role::where('name', UserRole::FINANCE->value)
                ->pluck('id')
                ->first();

            $status = RequestApprovalStatus::valueOf($request->input('status'));

            $this->updateRequest($status, $roleID, $expenseRequestID);

            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'something went wrong']);
        }
    }

    public function updateAuditor(Request $request, $expenseRequestID)
    {

        try {

            $roleID = Role::where('name', UserRole::AUDITOR->value)
                ->pluck('id')
                ->first();

            $status = RequestApprovalStatus::valueOf($request->input('status'));

            $this->updateRequest($status, $roleID, $expenseRequestID);

            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['message' => 'something went wrong']);
        }
    }


    /**
     * @throws \Exception
     */
    private function updateRequest(RequestApprovalStatus $status, $roleID, $expenseRequestID): void
    {
        try {

            DB::beginTransaction();

            $this->updateRequestApproval->handle($expenseRequestID, $roleID, $status);

            $this->addRequestLog->handle($expenseRequestID, 'request status was set to ' . $status->name);

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();

            throw  $exception;
        }
    }
}
