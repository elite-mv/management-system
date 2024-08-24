<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\BookKeeperApproval;
use App\Models\Expense\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;

class BookKeeperController extends Controller
{

    public function index(Request $request)
    {
//        $requests = ModelsRequest::query();
//
//        $requests->where('priority', false);
//
//        $requests->when($request->input('status'), function ($query) use ($request) {
//            $query->whereHas('bookkeeperApproval',function ($query) use ($request) {
//                if ($request->input('status') !== 'ALL') {
//                    $query->where('status', $request->input('status'));
//                }
//            });
//        }, function ($query){
////            $query->where(function ($query)  {
//                $query->whereDoesntHave('bookkeeperApproval');
////            });
//        });
//
//        $requests->when($request->input('search'), function ($query) use ($request) {
//            $query->where(function ($query) use ($request) {
//                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$request->input('search')]);
//                $query->orWhere('request_by', 'LIKE', $request->input('search') . '%');
//            });
//        });
//
//        return $requests->toSql();

        return view('expense.book-keeper-requests', []);
    }

    public function getRequests(Request $request)
    {

        $query = ModelsRequest::query();

        $query->when($request->input('search'), function ($qb) use ($request) {
            $qb->where('id',Helper::rawID($request->input('search')));
            $qb->orWhere('request_by', 'LIKE', $request->input('search') . '%');

            $qb->orWhereRaw("DATE_FORMAT(created_at, '%Y%m%d') LIKE ?", [Helper::rawReference($request->input('search'))]);
        });

        $query->when($request->input('entity'), function ($qb) use ($request) {
            if($request->input('entity') != 'ALL') {
                $qb->where('company_id',$request->input('entity'));
            }
        });

        $query->when($request->input('paymentStatus'), function ($qb) use ($request) {
            if($request->input('paymentStatus') != 'ALL') {
                $qb->where('status',$request->input('paymentStatus'));
            }
        });

        $query->when($request->input('from'), function ($qb) use ($request) {
            $qb->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d',$request->input('from'))->toDateString());
        });

        $query->when($request->input('to'), function ($qb) use ($request) {
            $qb->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d',$request->input('to'))->toDateString());
        });

        $query->whereHas('approvals', function ($qb) use ($request) {

            $qb->when($request->input('status') && $request->input('status') != 'ALL' , function ($q) use ($request) {
                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));
            });

            $qb->whereHas('role', function ($q){
                $q->where('name', UserRole::BOOK_KEEPER->value);
            });

        });

        $total = $query->get()->sum(fn($item) => $item->fund);

        $requests = $query->paginate($request->input('entries') ?? 10, ['*'],  'page',   $request->input('page') ?? 1);

        return view('expense.partials.request-data',
            [
                'requests' => $requests,
                'total' => $total,
                'page' => $request->input('page'),
            ]
        );
    }

    private function search($query, $data)
    {
        $query->when($data->input('search'), function ($queryBuilder) use ($data) {
            $queryBuilder->where(function ($query) use ($data) {
                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$data->input('search')]);
                $query->orWhere('request_by', 'LIKE', $data->input('search') . '%');
            });
        });
    }
}

