<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
use App\Helper\Helper;
use App\Models\Expense\BookKeeperApproval;
use App\Models\Expense\Request as ModelsRequest;
use Illuminate\Http\Request;
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
        });

        $query->whereHas('approvals', function ($qb) use ($request) {

            $qb->when($request->input('status') && $request->input('status') != 'ALL' , function ($q) use ($request) {
                $q->where('status', RequestApprovalStatus::valueOf($request->input('status')));
            });

            $qb->whereHas('role', function ($q){
                $q->where('name', UserRole::BOOK_KEEPER->value);
            });
        });

        $requests = $query->paginate($request->input('entries'));

        return view('expense.partials.request-data', ['requests' => $requests]);
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
