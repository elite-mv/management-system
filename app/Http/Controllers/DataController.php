<?php

namespace App\Http\Controllers;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestPriorityLevel;
use App\Models\Expense\Company;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use App\Models\Expense\RequestItem;
use App\Models\Expense\User;
use App\Models\OldRequest;
use App\Models\OldRequestList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expense\Request as ExpenseRequest;
use Illuminate\Support\Facades\Session;

class DataController
{
    public function index(Request $request){

        try {

            DB::beginTransaction();

            $requestList = OldRequestList::all();

            foreach ($requestList as $item ){

                $companyId = Company::where('name', $item->entity)->pluck('id')->first();

                $supplier = $item->supplier;
                $requestBy = $item->requested_by;
                $preparedBy = User::where('email', $item->email)->pluck('id')->first();
                $paidTo = $item->paid_to;

                $expenseRequest = ExpenseRequest::create([
                    'company_id' => $companyId,
                    'supplier' => $supplier,
                    'request_by' => $requestBy,
                    'prepared_by' => $preparedBy,
                    'paid_to' => $paidTo,
                    'priority_level' => RequestPriorityLevel::NONE->name,
                    'priority' => 1,
                ]);

                $itemRequests = OldRequest::where('reference', $item->reference)->get();

                // Request Items
                foreach ($itemRequests as $requestItem){

                    $jobOrderId = JobOrder::where('reference', $requestItem->job_order)->pluck('id')->first();
                    $measurementId = Measurement::where('name', $requestItem->uom)->pluck('id')->first();

                    if(!isset($jobOrderId)){
                        $jobOrderId   = JobOrder::where('reference', 'UNKNOWN')->pluck('id')->first();
                    }

                    RequestItem::create([
                        'quantity' => $requestItem->qty,
                        'cost' => $requestItem->unit_cost,
                        'description' => $requestItem->description,
                        'measurement_id' => $measurementId,
                        'request_id' => $expenseRequest->id,
                        'job_order_id' => $jobOrderId,
                        'session_id' => '123',
                        'status' => RequestApprovalStatus::valueOf($requestItem->status)
                    ]);

                }


            }

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ],500);
        }

    }
}
