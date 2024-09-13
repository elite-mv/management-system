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
use App\Models\Expense\RequestLogs;
use App\Models\Expense\Role;
use App\Models\Expense\User;
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


    public function addRequest(Request $request, AddRequestLog $addRequestLog)
    {

        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'company' => 'required',
                'supplier' => 'required',
                'requestedBy' => 'required',
                'paidTo' => 'required',
                'priorityLevel' => 'required',
                'priority' => 'nullable',
            ]);

            $expenseRequest = new ModelsRequest();

            $expenseRequest->company_id = $validated['company'];
            $expenseRequest->supplier = $validated['supplier'];
            $expenseRequest->request_by = $validated['requestedBy'];
            $expenseRequest->prepared_by = Auth::id();
            $expenseRequest->paid_to = $validated['paidTo'];

            $expenseRequest->priority_level = RequestPriorityLevel::valueOf($validated['priorityLevel']);
            $expenseRequest->priority = isset($validated['priority']) ? 1 : 0;

            $expenseRequest->save();

            // get all request item that have no request id but have the same session id
            $requestItems = RequestItem::where('session_id', Session::getId())
                ->whereNull('request_id')
                ->get();

            if (!count($requestItems)) {
                throw new \Exception('Empty items');
            }

            foreach ($requestItems as $item) {
                $item->request_id = $expenseRequest->id;
                $item->save();
            }

            if ($expenseRequest->priority) {

                RequestApproval::create([
                    'request_id' => $expenseRequest->id,
                    'status' => RequestApprovalStatus::PENDING->name,
                    'role_id' => Role::where('name', UserRole::FINANCE->value)->pluck('id')->first(),
                ]);

            } else {
                RequestApproval::create([
                    'request_id' => $expenseRequest->id,
                    'status' => RequestApprovalStatus::PENDING->name,
                    'role_id' => Role::where('name', UserRole::BOOK_KEEPER->value)->pluck('id')->first(),
                ]);
            }

            $addRequestLog->handle($expenseRequest->id, 'Request was created');

            DB::commit();

            return redirect('/expense/requests');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function getRequests(Request $request)
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

        $query->with('items', function ($query) {
            $query->select('request_id', DB::raw('SUM(quantity * cost) as total_cost'))
                ->groupBy('request_id');
        });

        if ($request->input('order') && $request->input('order') === 'ASC') {
            $query->orderBy('created_at');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $query->where('prepared_by', Auth::id());

        $requests = $query->paginate($request->input('entries') ?? 20, ['*'], 'page', $request->input('page') ?? 1);

        return view('expense.requests', ['requests' => $requests]);
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

        $viewForm = 'expense.printable-request-form';

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
                                $q->select(['id', 'name', 'reference']);
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
                'expenseTypes' => function ($q) {
                    $q->with(['category']);
                },
                'bankDetails' => function ($q) {
                    $q->with(['bank', 'code']);
                },
                'checkVoucher',
            ])
            ->firstOrFail();

        if (!Gate::allows('view-request', $expenseRequest)) {
            abort(403);
        }

        $role = Auth::user()->role;

        switch ($role->name) {
            case UserRole::BOOK_KEEPER->value:

                if ($expenseRequest->bookKeeper && $expenseRequest->bookKeeper->status != RequestApprovalStatus::PENDING) {
                    $viewForm = 'expense.view-request-form';
                }
                break;
            case UserRole::ACCOUNTANT->value:


                if ($expenseRequest->accountant && $expenseRequest->accountant->status != RequestApprovalStatus::PENDING) {
                    $viewForm = 'expense.view-request-form';
                }

                break;
            case UserRole::AUDITOR->value:

                if ($expenseRequest->auditor && $expenseRequest->auditor->status != RequestApprovalStatus::PENDING) {
                    $viewForm = 'expense.view-request-form';
                }
                break;

            case UserRole::STAFF->value:

                $viewForm = 'expense.view-request-form';
                break;
        }

        $measurements = Measurement::select(['id', 'name'])->get();
        $jobOrder = JobOrder::select(['id', 'name', 'reference'])->get();

        $logs = RequestLogs::select(['id', 'description', 'user_id', 'created_at'])
            ->where('request_id', '=', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view($viewForm, [
            'request' => $expenseRequest,
            'jobOrders' => $jobOrder,
            'measurements' => $measurements,
            'logs' => $logs,
        ]);

    }

    public function updatePaymentMethod(Request $request, AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'mode' => 'required'
            ]);

            DB::beginTransaction();

            $requestModel = ModelsRequest::findOrFail($requestID);

            $paymentMethod = PaymentMethod::valueOf($validated['mode']);

            $requestModel->payment_method = $paymentMethod;

            $requestModel->save();

            $addRequestLog->handle($requestID, 'payment method was set to ' . $paymentMethod->name);

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

    public function updateAttachment(Request $request, AddRequestLog $addRequestLog, $id)
    {

        try {

            $validated = $request->validate([
                'attachment' => 'required'
            ]);

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::findOrFail($id);

            $attachment = AccountingAttachment::valueOf($validated['attachment']);

            $modelsRequest->attachment = $attachment;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request attachment was set to ' . $attachment->name);

            DB::commit();

            return response()->json(['message' => 'ok',]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong'], 400);
        }

    }

    public function updateType(Request $request, AddRequestLog $addRequestLog, $id)
    {

        try {

            $validated = $request->validate([
                'type' => 'required'
            ]);

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::findOrFail($id);

            $type = AccountingType::valueOf($validated['type']);

            $modelsRequest->type = $type;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request type was set to ' . $type->name);

            DB::commit();

            return response()->json(['message' => 'ok']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong'], 500);
        }

    }

    public function updateReceipt(Request $request, AddRequestLog $addRequestLog, $id)
    {

        try {
            $validated = $request->validate([
                'receipt' => 'required'
            ]);

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::findOrFail($id);

            $receipt = AccountingReceipt::valueOf($validated['receipt']);
            $modelsRequest->receipt = $receipt;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request receipt was set to ' . $receipt->name);

            DB::commit();

            return response()->json(['message' => 'ok']);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    public function updatePriorityLevel(Request $request, AddRequestLog $addRequestLog, $id)
    {
        try {

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $priority = RequestPriorityLevel::valueOf($request->input('priority_level'));
            $modelsRequest->priority_level = $priority;

            $modelsRequest->save();

            $addRequestLog->handle($id, 'request priority was set to ' . $priority->name);

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

    public function updateRequestStatus(Request $request, AddRequestLog $addRequestLog, ModelsRequest $expenseRequest)
    {
        try {

            DB::beginTransaction();

            $status = RequestStatus::valueOf($request->input('status'));

            $expenseRequest->status = $status;

            $expenseRequest->save();

            $addRequestLog->handle($expenseRequest->id, 'request payment status was set to ' . $status->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function updateFundStatus(Request $request, AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'status' => 'required|string'
            ]);

            DB::beginTransaction();

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->fund_status = RequestFundStatus::valueOf($validated['status']);

            $requestModel->save();

            $addRequestLog->handle($requestID, 'request fund status was set to ' . $requestModel->fund_status->name);

            DB::commit();

            return response()->json([
                'message' => 'ok',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function updateReceivedBy(Request $request, AddRequestLog $addRequestLog, $requestID)
    {

        try {

            $validated = $request->validate([
                'received_by' => 'required|string',
            ]);

            DB::beginTransaction();

            $receivedBy = $validated['received_by'];

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->received_by = $receivedBy;

            $requestModel->save();

            $addRequestLog->handle($requestID, 'request received by was change to ' . $receivedBy);

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

    public function auditedBy(Request $request, AddRequestLog $addRequestLog, $requestID)
    {

        try {

            $validated = $request->validate([
                'audited_by' => 'required|string',
            ]);

            DB::beginTransaction();

            $auditedBy = $validated['audited_by'];

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->audited_by = $auditedBy;

            $requestModel->save();

            $addRequestLog->handle($requestID, 'request audited by was change to ' . $auditedBy);

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

    public function updatePaidTo(Request $request, $requestID)
    {

        try {

            $validated = $request->validate([
                'paid_to' => 'required|string',
            ]);

            DB::beginTransaction();

            $paidTo = $validated['paid_to'];

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->paid_to = $paidTo;

            $requestModel->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ],
                500
            );
        }
    }

    public function updateOthers(Request $request, $requestID)
    {

        try {

            $validated = $request->validate([
                'others' => 'required|string',
            ]);

            DB::beginTransaction();

            $others = $validated['others'];

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->others = $others;

            $requestModel->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ],
                500
            );
        }
    }

    public function updateTerms(Request $request, $requestID)
    {

        try {

            $validated = $request->validate([
                'terms' => 'required|string',
            ]);

            DB::beginTransaction();

            $terms = $validated['terms'];

            $requestModel = ModelsRequest::findOrFail($requestID);

            $requestModel->terms = $terms;

            $requestModel->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ],
                500
            );
        }
    }

    public function nextRequest($requestID)
    {

        try {

            $id = ModelsRequest::select(['requests.id'])
                ->join('request_approvals', 'requests.id', '=', 'request_approvals.request_id')
                ->join('roles', 'roles.id', '=', 'request_approvals.role_id')
                ->where(function ($query) use ($requestID) {

                    $query->where('request_approvals.status', '=', RequestApprovalStatus::PENDING->name);
                    $query->where('roles.name', '=', Auth::user()->role->name);

                    $query->where('requests.id', '>', $requestID);

                })
                ->orderBy('requests.id')
                ->pluck('id')
                ->first();

            if (!isset($id)) {
                throw new \Exception('No more next request');
            }

            return redirect()->route('request', ['id' => $id]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
        }

    }

    public function prevRequest($requestID)
    {

        try {

            $id = ModelsRequest::select(['requests.id'])
                ->join('request_approvals', 'requests.id', '=', 'request_approvals.request_id')
                ->join('roles', 'roles.id', '=', 'request_approvals.role_id')
                ->where(function ($query) use ($requestID) {

                    $query->where('request_approvals.status', '=', RequestApprovalStatus::PENDING->name);
                    $query->where('roles.name', '=', Auth::user()->role->name);

                    $query->where('requests.id', '<', $requestID);

                })
                ->orderBy('requests.id', 'DESC')
                ->pluck('id')
                ->first();

            if (!isset($id)) {
                throw new \Exception('No more previous request');
            }

            return redirect()->route('request', ['id' => $id]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
