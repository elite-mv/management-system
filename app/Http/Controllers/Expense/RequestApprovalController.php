<?php

namespace App\Http\Controllers\Expense;

use App\Actions\AddRequestLog;
use App\Actions\UpdateRequestApproval;
use App\Enums\RequestApprovalStatus;
use App\Enums\RequestFundStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Models\Expense\RequestApproval;
use App\Models\Expense\RequestItem;
use App\Models\Expense\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;

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

            $roleID = Role::where('name', UserRole::BOOK_KEEPER->value)
                ->pluck('id')
                ->first();


            $status = RequestApprovalStatus::valueOf($request->input('status'));

            $passToAccountant = function () use ($expenseRequestID, $status) {

                if ($status == RequestApprovalStatus::APPROVED) {

                    RequestApproval::create([
                        'request_id' => $expenseRequestID,
                        'status' => RequestApprovalStatus::PENDING->name,
                        'role_id' => Role::where('name', UserRole::ACCOUNTANT->value)->pluck('id')->first(),
                    ]);
                }
            };

            $this->updateRequest($status, $roleID, $expenseRequestID, $passToAccountant);

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

            $approveItems = function () use ($expenseRequestID, $status) {

                if ($status != RequestApprovalStatus::APPROVED) {
                    return;
                }

                RequestItem::where('request_id', $expenseRequestID)
                    ->whereIn('status', [RequestItemStatus::PENDING->name])
                    ->update(['status' => RequestItemStatus::APPROVED->name]);

                RequestApproval::create([
                    'request_id' => $expenseRequestID,
                    'status' => RequestApprovalStatus::PENDING->name,
                    'role_id' => Role::where('name', UserRole::FINANCE->value)->pluck('id')->first(),
                ]);

                $this->addRequestLog->handle($expenseRequestID, 'The system automatically approve all pending items upon accountant approval');
            };


            $this->updateRequest($status, $roleID, $expenseRequestID, $approveItems);

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

            $releaseExpense = function () use ($expenseRequestID, $status) {

                if ($status != RequestApprovalStatus::APPROVED) {
                    return;
                }

                $request = \App\Models\Expense\Request::findOrFail($expenseRequestID);
                $request->status = \App\Enums\RequestStatus::RELEASED->value;
                $request->save();

                RequestApproval::create([
                    'request_id' => $expenseRequestID,
                    'status' => RequestApprovalStatus::PENDING->name,
                    'role_id' => Role::where('name', UserRole::AUDITOR->value)->pluck('id')->first(),
                ]);

                $this->addRequestLog->handle($expenseRequestID, 'The system automatically released the expense upon finance/president approval');
            };

            $this->updateRequest($status, $roleID, $expenseRequestID, $releaseExpense);

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
    private function updateRequest(RequestApprovalStatus $status, $roleID, $expenseRequestID, $callback = null): void
    {
        try {

            DB::beginTransaction();

            $this->updateRequestApproval->handle($expenseRequestID, $roleID, $status);

            $this->addRequestLog->handle($expenseRequestID, 'request status was set to ' . $status->name);

            if (isset($callback)) {
                $callback();
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();

            throw  $exception;
        }
    }
}
