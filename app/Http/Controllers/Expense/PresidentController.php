<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\RequestItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;

class PresidentController extends Controller
{
    public function index(Request $request)
    {
        $query = ModelsRequest::query();

        $query->select(['id', 'reference', 'request_by', 'company_id', 'status', 'supplier','created_at']);

        $query->with('items', function ($query) {
            $query->select('request_id', DB::raw('SUM(quantity * cost) as total_cost'))
                ->groupBy('request_id');
        });

        $query->with('company', function ($query) {
            $query->select(['id', 'name']);
        });

        $query->when($request->input('search'), function ($qb) use ($request) {
            $qb->where(function ($qb) use ($request) {
                $qb->where('id', Helper::rawID($request->input('search')));
                $qb->orWhere('supplier', 'LIKE', $request->input('search') . '%');
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

        $query->whereHas('approvals', function ($qb) use ($request) {

            $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($q) use ($request) {

                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));

                $q->whereHas('role', function ($q) {
                    $q->where('name', UserRole::PRESIDENT->value);
                    $q->orWhere('name', UserRole::FINANCE->value);
                });
            });
        });

        $query->when(!$request->input('status'), function ($qb) use ($request) {
            $qb->orderBy('created_at', 'DESC');
        }, function ($qb) use ($request) {
            switch ($request->input('status')) {
                case  RequestApprovalStatus::PENDING->name:
                    $qb->orderBy('created_at');
                    break;
                default:
                    $qb->orderBy('created_at', 'DESC');
                    break;
            }
        });

        $requests = $query->paginate($request->input('entries') ?? 20, ['*'], 'page', $request->input('page') ?? 1);

        $total = self::getTotal($request);

        return view('expense.president-requests', [
            'requests' => $requests->appends(request()->except('page')),
            'total' => $total,
        ]);
    }

    public function getTotal(Request $request)
    {

        return RequestItem::select([DB::raw('SUM(quantity * cost) as total_cost')])
            ->whereHas('request', function ($query) use ($request) {

                $query->with('company', function ($query) {
                    $query->select(['id', 'name']);
                });

                $query->when($request->input('search'), function ($qb) use ($request) {
                    $qb->where(function ($qb) use ($request) {
                        $qb->where('id', Helper::rawID($request->input('search')));
                        $qb->orWhere('supplier', 'LIKE', $request->input('search') . '%');
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

                $query->whereHas('approvals', function ($qb) use ($request) {

                    $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($q) use ($request) {

                        $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));

                        $q->whereHas('role', function ($q) {
                            $q->where('name', UserRole::PRESIDENT->value);
                            $q->orWhere('name', UserRole::FINANCE->value);
                        });
                    });
                });

            })
            ->value('total_cost');

    }


    public function getRequests(Request $request)
    {
        $query = ModelsRequest::query();

        $query->select(['id', 'reference', 'request_by', 'company_id', 'status']);

        $query->with('items', function ($query) {
            $query->select('request_id', DB::raw('SUM(quantity * cost) as total_cost'))
                ->groupBy('request_id');
        });

        $query->with('company', function ($query) {
            $query->select(['id', 'name']);
        });

        $query->when($request->input('search'), function ($qb) use ($request) {
            $qb->where(function ($qb) use ($request) {
                $qb->where('id', Helper::rawID($request->input('search')));
                $qb->orWhere('supplier', 'LIKE', $request->input('search') . '%');
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

        $query->when(!$request->input('status'), function ($qb) use ($request) {
            $qb->orderBy('created_at', 'DESC');
        }, function ($qb) use ($request) {
            switch ($request->input('status')) {
                case  RequestApprovalStatus::PENDING->name:
                    $qb->orderBy('created_at');
                    break;
                default:
                    $qb->orderBy('created_at', 'DESC');
            }
        });

        $query->whereHas('approvals', function ($qb) use ($request) {

            $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($q) use ($request) {

                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));

                $q->whereHas('role', function ($q) {
                    $q->where('name', UserRole::PRESIDENT->value);
                    $q->orWhere('name', UserRole::FINANCE->value);
                });
            });
        });

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);

        return view('expense.partials.request-president-data',
            [
                'requests' => $requests,
            ]
        );
    }

}
