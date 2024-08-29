<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditorController extends Controller
{
    public function  index()
    {
        return view('expense.auditor-requests');
    }

    public function getRequests(Request $request)
    {
        $query = ModelsRequest::query();

        $query->select(['id','reference', 'request_by', 'company_id', 'status']);

        $query->with('items', function ($query) {
            $query->select('request_id',DB::raw('SUM(quantity * cost) as total_cost'))
                ->groupBy('request_id');
        });

        $query->with('company', function ($query) {
            $query->select(['id', 'name']);
        });

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

        $query->whereHas('approvals', function ($qb) use ($request) {

            $approvedRoles = [
                UserRole::BOOK_KEEPER->value,
                UserRole::ACCOUNTANT->value,
                UserRole::FINANCE->value,
            ];

            $qb->where(function ($qb) use ($request, $approvedRoles) {
                $qb->whereHas('role', function ($qb) use ($request,$approvedRoles) {
                    $qb->whereIn('name', $approvedRoles)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            });

            $qb->orWhere(function ($qb) use ($request) {
                $qb->whereHas('role', function ($qb) use ($request) {
                    $qb->where('name', UserRole::AUDITOR->value);
                    $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($qb) use ($request) {
                        $qb->where('status', RequestApprovalStatus::valueOf($request->input('status')));
                    });
                });
            });

        }, '=', 4);

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);

        return view('expense.partials.request-data',
            [
                'requests' => $requests,
            ]
        );
    }


}
