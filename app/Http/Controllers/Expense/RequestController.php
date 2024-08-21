<?php

namespace App\Http\Controllers\Expense;

use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\PaymentMethod;
use App\Enums\RequestPriorityLevel;
use App\Models\Expense\Company;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\RequestItem;
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

    public function addRequest(Request $request)
    {

        DB::beginTransaction();

        try {
            $expenseRequest = new ModelsRequest();

            $expenseRequest->company_id = $request->input('company');
            $expenseRequest->supplier = $request->input('supplier');
            $expenseRequest->request_by = $request->input('requestedBy');
            $expenseRequest->prepared_by = Auth::id();
            $expenseRequest->paid_to = $request->input('paidTo');

            $expenseRequest->priority_level = RequestPriorityLevel::LOW->name;
            $expenseRequest->priority = true;

            $expenseRequest->save();

            // get all request item that have no request id but have the same session id
            $requestItems = RequestItem::where('session_id', Session::getId())
                ->whereNull('request_id')
                ->get();

            foreach ($requestItems as $item) {
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

    public function getRequests(Request $request)
    {
        return view('expense.requests');
    }

    public function getRequestsData(Request $request)
    {

//        $query = ModelsRequest::query();
//
//        $query->when($request->input('status'), function ($query) use ($request) {
//            if ($request->input('status') !== 'ALL') {
//                $query->where('status', $request->input('status'));
//            }
//        });
//
//        $query->when($request->input('search'), function ($query) use ($request) {
//            $query->where(function ($query) use ($request) {
//                $query->whereRaw("CONCAT(DATE_FORMAT(`created_at`, '%Y%m%d'), '-', `id`) = ?", [$request->input('search')]);
//                $query->orWhere('request_by', 'LIKE', $request->input('search') . '%');
//            });
//        });
//
//        $requests = $query->paginate($request->input('entries'));
        $requests = ModelsRequest::get();

        return view('expense.partials.request-data', ['requests' => $requests]);

    }

    public function viewRequest(int $id)
    {
        $expenseRequest = ModelsRequest::where('id', $id)->firstOrFail();

        if (!Gate::allows('view-request', $expenseRequest)) {
            abort(403);
        }

        $measurements = Measurement::get();
        $jobOrder = JobOrder::get();

        return view('expense.printable-request-form', [
            'request' => $expenseRequest,
            'measurements' => $measurements,
            'jobOrders' => $jobOrder,
        ]);

    }

    public function updatePaymentMethod(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            $requestModel = ModelsRequest::where('id', $requestID)->firstOrFail();

            $requestModel->payment_method = PaymentMethod::valueOf($request->input('mode'));

            $requestModel->save();

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

    public function updateAttachment(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $modelsRequest->attachment = AccountingAttachment::valueOf($request->input('attachment'));

            $modelsRequest->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'status' => '200',
            ], 500);
        }

    }
    public function updateType(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $modelsRequest->type = AccountingType::valueOf($request->input('type'));

            $modelsRequest->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something went wrong',
                'status' => '200',
            ], 500);
        }

    }

    public function updateReceipt(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $modelsRequest->receipt = AccountingReceipt::valueOf($request->input('receipt'));

            $modelsRequest->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '200',
            ]);
        }

    }
    public function updatePriorityLevel(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $modelsRequest = ModelsRequest::where('id', $id)->firstOrFail();

            $modelsRequest->priority_level = RequestPriorityLevel::valueOf($request->input('priority_level'));

            $modelsRequest->save();

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '200',
            ], 500);
        }

    }

}
