<?php

namespace App\Http\Controllers\Expense;

use App\Actions\AddRequestLog;
use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\PaymentMethod;
use App\Enums\RequestApprovalStatus;
use App\Enums\RequestFundStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestPriorityLevel;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\Company;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\RequestApproval;
use App\Models\Expense\RequestItem;
use App\Models\Expense\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestController extends Controller
{
    public function index()
    {

        $companies = Company::all();
        $measurements = Measurement::all();
        $jobOrders = JobOrder::all();

        return view('expense.request', [
            'companies' => $companies,
            'measurements' => $measurements,
            'jobOrders' => $jobOrders
        ]);
    }

    public function getDailyRequest(Request $request)
    {

        $query = \App\Models\Expense\Request::query();


        $query->when($request->input('status') && $request->input('status') != 'ALL', function ($query)use ($request) {
            $query->where('status',  RequestStatus::valueOf($request->input('status')));
        });

        $query->with('company');
        $query->with('preparedBy');

        $query->where(function ($query){
            $query->where('created_at', '>=', Carbon::now()->startOfDay()->format('Y-m-d H:i:s'));
            $query->where('created_at', '<=', Carbon::now()->endOfDay()->format('Y-m-d H:i:s'));
        });

        return view('expense.daily-requests', [
            'requests' => $query->paginate(25),
        ]);
    }

    public function addRequest(Request $request, AddRequestLog $addRequestLog)
    {

        DB::beginTransaction();

        try {
            $expenseRequest = new ModelsRequest();

            $expenseRequest->company_id = $request->input('company');
            $expenseRequest->supplier = $request->input('supplier');
            $expenseRequest->request_by = $request->input('requestedBy');
            $expenseRequest->prepared_by = Auth::id();
            $expenseRequest->paid_to = $request->input('paidTo');

            $expenseRequest->priority_level = RequestPriorityLevel::LOW->name;
            $expenseRequest->priority = true;

            $expenseRequest->save();

            // get all request item that have no request id but have the same session id
            $requestItems = RequestItem::where('session_id', Session::getId())
                ->whereNull('request_id')
                ->get();

            foreach ($requestItems as $item) {
                $item->request_id = $expenseRequest->id;
                $item->save();
            }

            $roles = [
                UserRole::BOOK_KEEPER->value,
                UserRole::ACCOUNTANT->value,
                UserRole::FINANCE->value,
                UserRole::AUDITOR->value,
            ];

            foreach ($roles as $roleName) {
                RequestApproval::create([
                    'request_id' => $expenseRequest->id,
                    'status' => RequestApprovalStatus::PENDING,
                    'role_id' => Role::where('name', $roleName)->pluck('id')->first(),
                ]);
            }

            $addRequestLog->handle($expenseRequest->id, 'Request was created');

            DB::commit();

            return  redirect('/expense/requests');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getRequests(Request $request)
    {
        return view('expense.requests',
            []);
    }

    public function getRequestsData(Request $request)
    {

        $query = ModelsRequest::query();

        $query->when($request->input('search'), function ($qb) use ($request) {
            $qb->where(function ($qb) use ($request) {
                $qb->where('id', Helper::rawID($request->input('search')));
                $qb->orWhere('request_by', 'LIKE', $request->input('search') . '%');
                $qb->orWhere('reference', 'LIKE', $request->input('search') . '%');
            });
        });

        $query->when($request->input('entity') && $request->input('entity') != 'ALL', function ($qb) use ($request) {
            $qb->where('company_id', $request->input('entity'));
        });

        $query->when($request->input('paymentStatus') && $request->input('paymentStatus') != 'ALL', function ($qb) use ($request) {
            $qb->where('status', $request->input('paymentStatus'));
        });

        $query->when($request->input('from'), function ($qb) use ($request) {
            $qb->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $request->input('from'))->toDateString());
        });

        $query->when($request->input('to'), function ($qb) use ($request) {
            $qb->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $request->input('to'))->toDateString());
        });

        $query->where('prepared_by', Auth::id());

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);

        return view('expense.partials.request-data', ['requests' => $requests]);
    }

    public function viewRequest(int $id)
    {

        $expenseRequest = ModelsRequest::where('id', $id)
            ->with([
                'items' => function ($q) {
                    $q->select([
                        'id', 'request_id', 'quantity', 'cost', 'description', 'status', 'remarks', 'measurement_id', 'job_order_id',
                        DB::raw('SUM(quantity * cost) as total_cost')
                    ])
                        ->groupBy('id', 'request_id', 'quantity', 'cost', 'description', 'status', 'remarks', 'measurement_id', 'job_order_id')
                        ->with([
                            'measurement' => function ($q) {
                                $q->select(['id', 'name']);
                            },
                            'jobOrder' => function ($q) {
                                $q->select(['id', 'name']);
                            }
                        ]);
                },
                'approvedItems' => function ($q) {
                    $q->select([
                        'id', 'request_id', 'quantity', 'cost', 'description', 'status', 'remarks', 'measurement_id', 'job_order_id',
                        DB::raw('SUM(quantity * cost) as total_cost')
                    ])
                        ->whereIn('status', [RequestItemStatus::PRIORITY->name, RequestItemStatus::APPROVED->name])
                        ->groupBy('id', 'request_id', 'quantity', 'cost', 'description', 'status', 'remarks', 'measurement_id', 'job_order_id')
                        ->with([
                            'measurement' => function ($q) {
                                $q->select(['id', 'name']);
                            },
                            'jobOrder' => function ($q) {
                                $q->select(['id', 'name']);
                            }
                        ]);
                },
                'bookKeeper' => function ($q) {
                    $q->whereHas('role', function ($query) {
                        $query->where('name', UserRole::BOOK_KEEPER->value);
                    }, '=', '1');
                },
                'accountant' => function ($q) {
                    $q->whereHas('role', function ($query) {
                        $query->where('name', UserRole::ACCOUNTANT->value);
                    }, '=', '1');
                },
                'finance' => function ($q) {
                    $q->whereHas('role', function ($query) {
                        $query->where('name', UserRole::FINANCE->value);
                    }, '=', '1');
                },
                'auditor' => function ($q) {
                    $q->whereHas('role', function ($query) {
                        $query->where('name', UserRole::AUDITOR->value);
                    }, '=', '1');
                },
            ])
            ->firstOrFail();

        if (!Gate::allows('view-request', $expenseRequest)) {
            abort(403);
        }

        $measurements = Measurement::select(['id', 'name'])->get();
        $jobOrder = JobOrder::select(['id', 'name', 'reference'])->get();

        return view('expense.printable-request-form', [
            'request' => $expenseRequest,
            'jobOrders' => $jobOrder,
            'measurements' => $measurements
        ]);

    }

    public function updatePaymentMethod(Request $request, AddRequestLog $addRequestLog, $requestID)
    {
        try {

            DB::beginTransaction();

            $requestModel = ModelsRequest::where('id', $requestID)->firstOrFail();

            $paymentMethod =  PaymentMethod::valueOf($request->input('mode'));

            $requestModel->payment_method = $paymentMethod;

            $requestModel->save();

            $addRequestLog->handle($requestID->id, 'payment method was set to '. $paymentMethod->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ],
                500
            );
        }
    }

    public function updateAttachment(Request $request, AddRequestLog $addRequestLog,$id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $attachment = AccountingAttachment::valueOf($request->input('attachment'));

            $modelsRequest->attachment = $attachment;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request attachment was set to '. $attachment->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'status' => '200',
            ], 500);
        }

    }

    public function updateType(Request $request, AddRequestLog $addRequestLog, $id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $type = AccountingType::valueOf($request->input('type'));

            $modelsRequest->type = $type;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request type was set to '. $type->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'status' => '200',
            ], 500);
        }

    }

    public function updateReceipt(Request $request, AddRequestLog $addRequestLog, $id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $receipt =  AccountingReceipt::valueOf($request->input('receipt'));
            $modelsRequest->receipt = $receipt;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request receipt was set to '. $receipt->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '200',
            ]);
        }

    }

    public function updatePriorityLevel(Request $request, AddRequestLog $addRequestLog, $id)
    {
        try {

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $priority =  RequestPriorityLevel::valueOf($request->input('priority_level'));
            $modelsRequest->priority_level = $priority;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request priority was set to '. $priority->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '200',
            ], 500);
        }

    }

    public function updateRequestStatus(Request $request, AddRequestLog $addRequestLog,ModelsRequest $expenseRequest)
    {
        try {

            DB::beginTransaction();

            $status = RequestStatus::valueOf($request->input('status'));

            $expenseRequest->status = $status;

            $expenseRequest->save();

            $addRequestLog->handle($expenseRequest->id, 'request payment status was set to '. $status->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 200,
            ], 500);
        }

    }

    public function updateFundStatus(Request $request, AddRequestLog $addRequestLog,$requestID)
    {
        try {

            DB::beginTransaction();

            $requestModel = ModelsRequest::where('id', $requestID)->firstOrFail();

            $requestModel->fund_status = RequestFundStatus::valueOf($request->input('status'));

            $requestModel->save();

            $addRequestLog->handle($requestID->id, 'request fund status was set to '. $requestModel->fund_status->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ],
                500
            );
        }
    }
}
