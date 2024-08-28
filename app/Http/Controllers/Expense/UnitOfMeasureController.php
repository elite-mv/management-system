<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;
use App\Models\Expense\Measurement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UnitOfMeasureController extends Controller
{
    public function  index(Request $request)
    {
        $query = Measurement::query();

        $query->when($request->input('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('search'));
            });
        });

        $query->where('archive', '=',false);

        $measurements = $query->paginate(10);

        return view('expense.unit-of-measure', [
            'measurements' => $measurements,
        ]);
    }

    public function addMeasurement(Request $request){

        try {

            DB::beginTransaction();

            $measurement = new Measurement();

            $measurement->name = $request->input('name');
            $measurement->priority = $request->input('priority');

            $measurement->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function deleteMeasurement(Measurement $measurement){

        try {

            DB::beginTransaction();

            $measurement->archive = 1;

            $measurement->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function updateMeasurement(Request $request, Measurement $measurement){

        try {

            DB::beginTransaction();

            $measurement->name = $request->input('name');
            $measurement->priority = $request->input('priority');

            $measurement->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }
}
