<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\RequestItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookKeeperController extends Controller
{

    public function index(Request $request)
    {
        return view('expense.book-keeper-requests', []);
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

            $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($q) use ($request) {
                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));
            });

            $qb->whereHas('role', function ($q) {
                $q->where('name', UserRole::BOOK_KEEPER->value);
            });

        });

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);

        $total = $this->calculate($request);

        return view('expense.partials.request-data',
            [
                'requests' => $requests,
                'page' => $request->input('page'),
                'total' => $total,
            ]
        );
    }

    public function calculate(Request $request)
    {
        $query = RequestItem::query();

        $query->select(DB::raw('SUM(quantity * cost) as total'));

//        $query->when($request->input('search'), function ($qb) use ($request) {
//            $qb->whereHas('request',function ($qb) use ($request){
//                $qb->where(function ($qb) use ($request) {
//                    $qb->where('id', Helper::rawID($request->input('search')));
//                    $qb->orWhere('request_by', 'LIKE', $request->input('search') . '%');
//                    $qb->orWhere('reference', 'LIKE', $request->input('search') . '%');
//                });
//            });
//        });

        return $query->value('total');

//        return $query->toSql();


//        $query->when($request->input('entity') && $request->input('entity') != 'ALL', function ($qb) use ($request) {
//            $qb->where('company_id', $request->input('entity'));
//        });
//
//        $query->when($request->input('paymentStatus') && $request->input('paymentStatus') != 'ALL', function ($qb) use ($request) {
//            $qb->where('status', $request->input('paymentStatus'));
//        });
//
//        $query->when($request->input('from'), function ($qb) use ($request) {
//            $qb->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $request->input('from'))->toDateString());
//        });
//
//        $query->when($request->input('to'), function ($qb) use ($request) {
//            $qb->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $request->input('to'))->toDateString());
//        });
//
//        $query->whereHas('approvals', function ($qb) use ($request) {
//
//            $qb->when($request->input('status') && $request->input('status') != 'ALL', function ($q) use ($request) {
//                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));
//            });
//
//            $qb->whereHas('role', function ($q) {
//                $q->where('name', UserRole::BOOK_KEEPER->value);
//            });
//
//        });
//
//        $requests = $query->paginate($request->input('entries') ?? 10, ['*'], 'page', $request->input('page') ?? 1);
//
//        return view('expense.partials.request-data',
//            [
//                'requests' => $requests,
//                'page' => $request->input('page'),
//            ]
//        );
    }
}
