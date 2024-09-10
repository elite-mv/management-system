<?php

namespace App\Http\Controllers;

use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\Income\AttachmentType;
use App\Enums\PaymentMethod;
use App\Enums\RequestApprovalStatus;
use App\Enums\RequestFundStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestPriorityLevel;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckUserPin;
use App\Models\Expense\BankCode;
use App\Models\Expense\BankDetail;
use App\Models\Expense\BankName;
use App\Models\Expense\CheckVoucher;
use App\Models\Expense\Company;
use App\Models\Expense\ExpenseCategory;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use App\Models\Expense\RequestApproval;
use App\Models\Expense\RequestComment;
use App\Models\Expense\RequestDelivery;
use App\Models\Expense\RequestExpenseType;
use App\Models\Expense\RequestItem;
use App\Models\Expense\RequestItemImage;
use App\Models\Expense\RequestVat;
use App\Models\Expense\Role;
use App\Models\Expense\User;
use App\Models\OldComment;
use App\Models\OldRequest;
use App\Models\OldRequestList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigrationController
{
    public function index()
    {


        $test = null;

        $failedComments = [];

        try {
            DB::beginTransaction();

            $requests = OldRequestList::get();

            foreach ($requests as $request) {

                $items = OldRequest::where('reference', $request->reference)->get();

                $user = User::where('name', $request->prepared_by)->first();
                $company = Company::where('name', $request->entity)->first();
                $vatValues = explode(',', $request->value2);

                $saveRequest = \App\Models\Expense\Request::create([
                    'id' => $request->id,
                    'created_at' => $request->deyt,
                    'company_id' => $company ? $company->id : 1,
                    'supplier' => $request->supplier,
                    'paid_to' => $request->paid_to,
                    'request_by' => $request->requested_by,
                    'prepared_by' => $user ? $user->id : 1,
                    'priority_level' => RequestPriorityLevel::HIGH->name,
                    'priority' => $request->bk_status == 'Priority',
                    'payment_method' => PaymentMethod::NONE->value,
                    'attachment' => self::findAttachment($request->check2),
                    'type' => self::findType($request->check2),
                    'receipt' => self::findReceipt($request->check2),
                    'fund_status' => self::findFund($request->check2),
                    'reference' => $request->reference,
                    'received_by' => $request->paid_to ?? $request->requested_by,
                    'audited_by' => $request->aud_status ? 'KEEFER' : '',
                    'status' => RequestStatus::valueOf($request->status ?? RequestStatus::PENDING->name)->value,
                    'terms' => $request->terms ?? '',
                    'others' => $vatValues[6] ?? '',
                ]);

                $checkVoucher = $request->check_voucher;

                if ($checkVoucher) {
                    CheckVoucher::create([
                        'id' => explode('-', $checkVoucher)[1],
                        'request_id' => $request->id,
                    ]);
                }

                $bankName = BankName::where('name', $request->bank_name)->first();
                $bankCode = BankCode::where('code', $request->bank_code)->first();

                BankDetail::create([
                    'request_id' => $request->id,
                    'bank_name_id' => $bankName ? $bankName->id : null,
                    'bank_code_id' => $bankCode ? $bankCode->id : null,
                    'check_number' => $request->check_number,
                ]);

                RequestDelivery::create([
                    'request_id' => $request->id,
                    'completed' => self::isDelivered($request->check2) ? 1 : null,
                    'supplier_verified' => self::isSupplierVerified($request->check2) ? 1 : null,
                ]);


                RequestVat::create([
                    'purchase_order' => $vatValues[2] ?? '',
                    'invoice' => $vatValues[3] ?? '',
                    'bill' => $vatValues[4] ?? '',
                    'official_receipt' => $vatValues[5] ?? '',
                    'request_id' => $request->id,
                    'option_a' => $vatValues[0] ?? '',
                    'option_b' => $vatValues[1] ?? '',
                ]);

                $expenseTypes = explode('@', $request->value);

                foreach ($expenseTypes as $expenseType) {

                    $type = ExpenseCategory::where('name', $expenseType)->first();

                    RequestExpenseType::create([
                        'expense_category_id' => $type ? $type->id : 1,
                        'request_id' => $request->id
                    ]);
                }


                foreach ($items as $item) {

                    $jobOrder = JobOrder::where('reference', $item->job_order)->first();

                    $saveItem = RequestItem::create([
                        'quantity' => $item->qty,
                        'cost' => $item->unit_cost,
                        'description' => $item->description ?? '',
                        'measurement_id' => Measurement::where('name', $item->uom)->first()->id,
                        'job_order_id' => $jobOrder ? $jobOrder->id : JobOrder::where('reference', 'UNKNOWN')->first()->id,
                        'session_id' => '123',
                        'request_id' => $saveRequest->id,
                        'status' => RequestItemStatus::valueOf(strtoupper($item->status))->name,
                        'remarks' => $item->remarks ?? '',
                    ]);

                    $paths = explode('@', $item->thumbnail);
                    $revisedPath = '';

                    foreach ($paths as $path) {

                        if (str_contains($path, '../../temp/')) {
                            $revisedPath = str_replace('../../temp/', 'public/', $path);
                        } else {
                            $revisedPath = str_replace('../temp/', 'public/', $path);
                        }

                        RequestItemImage::create([
                            'file' => $revisedPath,
                            'request_item_id' => $saveItem->id,
                        ]);

                    }
                }

                $bookKeeper = Role::where('name', UserRole::BOOK_KEEPER->value)->first()->id;
                $status = RequestApprovalStatus::valueOf(strtoupper($request->bk_status ?? RequestApprovalStatus::PENDING));

                if ($status && $status != RequestApprovalStatus::PRIORITY) {
                    RequestApproval::create([
                        'request_id' => $saveRequest->id,
                        'role_id' => $bookKeeper,
                        'user_id' => User::where('role_id', $bookKeeper)->first()->id,
                        'status' => RequestApprovalStatus::valueOf(strtoupper($request->bk_status))->name,
                        'created_at' => $request->bk_date,
                    ]);
                }

                $accountant = Role::where('name', UserRole::ACCOUNTANT->value)->first()->id;
                $acnStatus = RequestApprovalStatus::valueOf(strtoupper($request->acc_status) ?? RequestApprovalStatus::PENDING);

                if ($acnStatus && $acnStatus != RequestApprovalStatus::PRIORITY) {
                    RequestApproval::create([
                        'request_id' => $saveRequest->id,
                        'role_id' => $accountant,
                        'user_id' => User::where('role_id', $accountant)->first()->id,
                        'status' => $acnStatus->name,
                        'created_at' => $request->acc_date,
                    ]);
                }

                $finance = Role::where('name', UserRole::FINANCE->value)->first()->id;

                RequestApproval::create([
                    'request_id' => $saveRequest->id,
                    'role_id' => $finance,
                    'user_id' => User::where('role_id', $finance)->first()->id,
                    'status' => $request->fin_status ? RequestApprovalStatus::valueOf($request->fin_status)->name : RequestApprovalStatus::PENDING->name,
                    'created_at' => $request->fin_date ?? Carbon::now()->format('Y-m-d H:i'),

                ]);


                $auditor = Role::where('name', UserRole::AUDITOR->value)->first()->id;

                RequestApproval::create([
                    'request_id' => $saveRequest->id,
                    'role_id' => $auditor,
                    'user_id' => User::where('role_id', $auditor)->first()->id,
                    'status' => $request->aud_status ? RequestApprovalStatus::valueOf($request->aud_status)->name : RequestApprovalStatus::PENDING->name,
                    'created_at' => $request->aud_date ?? Carbon::now()->format('Y-m-d H:i'),
                ]);

            }
//
            $oldComments = OldComment::get();

            foreach ($oldComments as $oldComment) {
                try {
                    RequestComment::create([
                        'request_id' => \App\Models\Expense\Request::where('reference', $oldComment->reference)->firstOrFail()->id,
                        'message' => $oldComment->message,
                        'user_id' => User::where('name', $oldComment->username)->first()->id ?? 1,
                        'created_at' => $oldComment->date,
                    ]);
                } catch (\Exception $e) {
                    $failedComments[] = $oldComment;
                }
            }

            DB::commit();

            return [
                'failed_comment_count' => count($failedComments),
                'failed_comments' => $failedComments,
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    private function findAttachment($stringArray)
    {
        $array = explode(',', $stringArray);

        if (in_array('With', $array)) {
            return AccountingAttachment::WITH->name;
        } else if (in_array('Without', $array)) {
            return AccountingAttachment::WITHOUT->name;
        } else {
            return AccountingAttachment::DEFAULT->name;
        }
    }

    private function findType($stringArray)
    {
        $array = explode(',', $stringArray);

        if (in_array('OPEX', $array)) {
            return AccountingType::OPEX->name;
        } else if (in_array('NON OPEX', $array)) {
            return AccountingType::NON_OPEX->name;
        } else {
            return AccountingType::DEFAULT->name;
        }
    }

    private function findReceipt($stringArray)
    {
        $array = explode(',', $stringArray);

        if (in_array('Official Receipt VAT', $array)) {
            return AccountingReceipt::OFFICIAL_RECEIPT_VAT->name;
        } else if (in_array('Delivery Receipt', $array)) {
            return AccountingReceipt::DELIVERY_RECEIPT->name;
        } else {
            return AccountingReceipt::DEFAULT->name;
        }
    }

    private function findFund($stringArray)
    {
        $array = explode(',', $stringArray);

        if (in_array('FUNDED', $array)) {
            return RequestFundStatus::FUNDED->value;
        } else if (in_array('DECLINED', $array)) {
            return RequestFundStatus::DECLINED->value;
        } else {
            return RequestFundStatus::NONE->value;
        }
    }

    private function isDelivered($stringArray)
    {
        $array = explode(',', $stringArray);

        return in_array('Complete', $array);

    }

    private function isSupplierVerified($stringArray)
    {
        $array = explode(',', $stringArray);

        return in_array('Yes', $array);
    }


}
