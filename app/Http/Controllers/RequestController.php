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
            $expenseRequest->prepared_by = $request->input('requestedBy');
            $expenseRequest->paid_to = $request->input('paidTo');

            $expenseRequest->priority_level = RequestPriorityLevel::LOW->name;
            $expenseRequest->priority = false;

            $expenseRequest->save();

            // get all request item that has no request id but have the same session id
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
}
