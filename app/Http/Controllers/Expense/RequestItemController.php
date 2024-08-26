<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestItemStatus;
use App\Models\Expense\Measurement;
use App\Models\Expense\RequestItem;
use App\Models\Expense\RequestItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestItemController extends Controller
{

    public function addRequestItem(Request $request){

        $requestItem = new RequestItem();
        $measurement = Measurement::where('id', $request->input('measurement'))->firstOrFail();
        $jobOrder = Measurement::where('id', $request->input('jobOrder'))->firstOrFail();

        $requestItem->quantity = $request->input('quantity');
        $requestItem->cost = $request->input('cost');
        $requestItem->description = $request->input('description');

        $requestItem->measurement_id = $measurement->id;
        $requestItem->job_order_id = $jobOrder->id;
        $requestItem->session_id = Session::getId();

        $requestItem->save();

        return ['message' => 'item added'];
    }

    public function updateRequestItem(Request $request, RequestItem $requestItem){

        try{
            DB::beginTransaction();

            $requestItem->job_order_id = $request->input('jobOrder');
            $requestItem->measurement_id = $request->input('measurement');
            $requestItem->quantity = $request->input('quantity');
            $requestItem->cost = $request->input('cost');
            $requestItem->description = $request->input('description');
            $requestItem->remarks = $request->input('remarks');

            $requestItem->status = RequestItemStatus::valueOf($request->input('status'))->name;
            $requestItem->save();

            Db::commit();

            return redirect()->route('request', ['id' => $requestItem->request_id]);

        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('request', ['id' => $requestItem->request_id])->withErrors();
        }

    }

    public function getRequestItems(){

        $requestItems =  RequestItem::where('session_id', Session::getId())
        ->whereNull('request_id')->get();

        return view('expense.partials.request-cart', [
            'requestItems' => $requestItems,
        ]);
    }

    public function getRequestItem($id){

        $requestItem =  RequestItem::where('id', $id)->with('attachments')->firstOrFail();

        return response()->json([
            'item' => $requestItem,
        ]);

    }

    public function updateItem(Request $request, $id){

        //check first if the item is present
        $requestItem = RequestItem::findOrFail($id);

        $requestItem->quantity = $request->input('quantity');
        $requestItem->measurement_id = $request->input('measurement');
        $requestItem->job_order_id = $request->input('jobOrder');
        $requestItem->description = $request->input('description');
        $requestItem->cost = $request->input('cost');

        $requestItem->save();
    }

    public function removeItem($id){
        RequestItem::findOrFail($id)->delete();

        return ['message' => 'item deleted'];
    }

    public function addRequestItemImage(Request $request, $id){

        $images = [];


        try{


        foreach ($request->file('files') as $file) {

            $filename = $file->store('public');

            $requestImage = new RequestItemImage();
                $requestImage->file = $filename;
                $requestImage->request_item_id = $id;
                $requestImage->save();
                $images[] = $filename;
        }

        return ['images' =>  $images];

    }catch(\Exception $e){

        return response()->json([
            'message' => $e->getMessage(),
        ], 500);

    }


    }

    public function getRequestTotal(){
        $total = DB::table('request_items')
        ->select(DB::raw('SUM(quantity * cost) as total'))
            ->where('session_id', '=', Session::getId())
            ->whereNull('request_id')
            ->first();

            return $total;
    }
}
