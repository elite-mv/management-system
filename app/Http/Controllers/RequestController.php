<?php

namespace App\Http\Controllers;

use App\Enums\RequestPriorityLevel;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Measurement;
use App\Models\JobOrder;
use App\Models\Request as ModelsRequest;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(){

        $companies = Company::all();
        $measurements = Measurement::all();
        $jobOrders = JobOrder::all();

        return view('request', [
            'companies' => $companies,
            'measurements' => $measurements,
            'jobOrders' => $jobOrders
        ]);
    }

    public function addRequest(Request $request){

        DB::beginTransaction();

        try {
            $expenseRequest = new ModelsRequest();

            $expenseRequest->company_id =  $request->input('company');
            $expenseRequest->supplier = $request->input('supplier');
            $expenseRequest->request_by = $request->input('requestedBy');
            $expenseRequest->prepared_by = Auth::id();
            $expenseRequest->paid_to = $request->input('paidTo');

            $expenseRequest->priority_level =  RequestPriorityLevel::LOW->name ;
            $expenseRequest->priority = true;

            $expenseRequest->save();

            // get all request item that have no request id but have the same session id
            $requestItems = RequestItem::where('session_id',  Session::getId())
                ->whereNull('request_id')
                ->get();

            foreach($requestItems as $item){
                $item->request_id = $expenseRequest->id;
                $item->save();
            }

            DB::commit();
            return ['message' => 'expense request added'];

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getRequests(Request $request){
        return view('requests');
    }

    public function getRequestsData(Request $request){

        $query = ModelsRequest::query();

        $query->when($request->input('status'), function ($query) use($request){
           if($request->input('status') !== 'ALL'){
            $query->where('status', $request->input('status'));
           }
        });

        $query->when($request->input('search'), function ($query) use($request){
            $query->where(function ($query) use ($request){
                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$request->input('search')]);
                $query->orWhere('request_by', 'LIKE' , $request->input('search'));
            });
        }); 

        $requests = $query->paginate($request->input('entries'));

        return view('/partials/request-data', ['requests' => $requests]);

    }


    public function viewRequest(int $id){
        
        $expenseRequest = ModelsRequest::where('id',$id)->firstOrFail();
        
        return view('printable-request-form', [
            'request' => $expenseRequest
        ]);

    }
}