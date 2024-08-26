<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function  index()
    {
        return view('expense.finance-requests', []);
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

        $query->whereHas('approvals', function ($qb) use ($request) {

            $qb->where(function ($qb) use ($request) {
                $qb->whereHas('role', function ($qb) use ($request) {
                    $qb->where('name', UserRole::BOOK_KEEPER->value)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            });

            $qb->orwhere(function ($qb) use ($request) {
                $qb->whereHas('role', function ($qb) use ($request) {
                    $qb->where('name', UserRole::ACCOUNTANT->value)
                        ->where('status', RequestApprovalStatus::APPROVED);
                });
            });


            $qb->orWhere(function ($qb) use ($request) {
                $qb->whereHas('role', function ($qb) use ($request) {
                    $qb->where('name', UserRole::FINANCE->value);
                    $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($qb) use ($request) {
                        $qb->where('status', RequestApprovalStatus::valueOf($request->input('status')));
                    });
                });
            });

        }, '=', 3);

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);

        return view('expense.partials.request-data',
            [
                'requests' => $requests,
            ]
        );
    }
}
