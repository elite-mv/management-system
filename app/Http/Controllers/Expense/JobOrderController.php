<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\JobOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobOrderController
{

    public function index(Request $request)
    {
        $query = JobOrder::query();

        $query->when($request->input('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('reference', 'like', '%' . $request->input('search'))
                    ->orwhere('name', 'like', '%' . $request->input('search'))
                    ->orwhere('client', 'like', '%' . $request->input('search'));
            });
        });

        $query->where('archive', '=',false);

        $jobOrders = $query->paginate(10);

        return view('expense.job-order', [
            'jobOrders' => $jobOrders,
        ]);
    }

    public function updateJobOrder(Request $request, JobOrder $jobOrder)
    {

        try {
            DB::beginTransaction();

            $jobOrder->name = $request->input('name');
            $jobOrder->reference = $request->input('reference');
            $jobOrder->client = $request->input('client');

            $jobOrder->save();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function addJobOrder(Request $request)
    {

        try {
            DB::beginTransaction();

            $jobOrder = new JobOrder();
            $jobOrder->name = $request->input('name');
            $jobOrder->reference = $request->input('reference');
            $jobOrder->client = $request->input('client');

            $jobOrder->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function archiveJobOrder(JobOrder $jobOrder)
    {

        try {
            DB::beginTransaction();
            $jobOrder->archive = 1;
            $jobOrder->save();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }
}
