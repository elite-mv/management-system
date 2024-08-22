<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestStatus;
use App\Models\Expense\BookKeeperApproval;
use App\Models\Expense\Request as ModelsRequest;
use Illuminate\Http\Request;
use function PHPUnit\TestFixture\func;

class BookKeeperController extends Controller
{

    public function  index(Request $request)
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

        $requests = ModelsRequest::query();

        $requests->where('priority', false);

        $requests->when($request->input('status'), function ($query) use ($request,$requests) {
            $query->whereHas('bookkeeperApproval',function ($query) use ($request,$requests) {
                switch ($request->input('status')) {
                    case 'ALL':
                        $requests->orWhereDoesntHave('bookkeeperApproval');
                    break;
                    case RequestApprovalStatus::PENDING->name:
                        $query->where('status', RequestApprovalStatus::PENDING->name);
                        $requests->orDoesntHave('bookkeeperApproval');
                        break;
                    case RequestApprovalStatus::APPROVED->name:
                        $query->where('status', RequestApprovalStatus::APPROVED->name);
                        break;
                    case RequestApprovalStatus::DISAPPROVE->name:
                        $query->where('status', RequestApprovalStatus::DISAPPROVE->name);
                        break;
                }
            });
        });

        $requests->when($request->input('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$request->input('search')]);
                $query->orWhere('request_by', 'LIKE', $request->input('search') . '%');
            });
        });

        $requests = $requests->paginate($request->input('entries'));

        return view('expense.partials.request-data', ['requests' => $requests]);
    }

    private  function search($query, $data)
    {
        $query->when($data->input('search'), function ($queryBuilder) use($data){
            $queryBuilder->where(function ($query) use ($data) {
                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$data->input('search')]);
                $query->orWhere('request_by', 'LIKE', $data->input('search') . '%');
            });
        });
    }
}
