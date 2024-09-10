<?php

namespace App\Http\Controllers\Expense;
use App\Models\Expense\RequestDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestDeliveryController extends Controller
{
    public function addDelivery(Request $request, $requestID)
    {

        $validated = $request->validate([
            'completed' => 'required',
        ]);

        try{
            DB::beginTransaction();

            RequestDelivery::updateOrCreate(['request_id' => $requestID], [
                'completed' => $validated['completed'],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);

        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ]);
        }
    }

    public function deleteDelivery($requestID)
    {

        try{
            DB::beginTransaction();

            RequestDelivery::where('request_id', $requestID)
                ->update(['completed' => null]);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);
        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ]);
        }
    }

    public function verifySupplier(Request $request, $requestID)
    {

        try{
            DB::beginTransaction();

            RequestDelivery::updateOrCreate(['request_id' => $requestID], [
                'supplier_verified' => $request->input('verified'),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);
        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ]);
        }
    }

    public function deleteSupplier($requestID)
    {

        try{
            DB::beginTransaction();

            RequestDelivery::where('request_id', $requestID)
                ->update(['supplier_verified' => null]);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => '200',
            ]);
        }catch (\Exception $e){

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => '500',
            ]);
        }
    }
}
