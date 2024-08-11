<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\RequestItem;
use App\Models\RequestItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    public function getRequestItems(){

        $requestItems =  RequestItem::where('session_id', Session::getId())
        ->whereNull('request_id')->get();

        return view('/partials/request-cart', [
            'requestItems' => $requestItems,
        ]);
    }

    public function getRequestItem($id){

        $requestItem =  RequestItem::where('id', $id)->firstOrFail();

        return $requestItem;
    }

    public function updateItem(Request $request, $id){

        //check first if the item is present
        $requestItem = RequestItem::findOrFail($id);

        $requestItem->quantity = $request->input('quantity');
        $requestItem->measurement_id = $request->input('measurement');
        $requestItem->job_order_id = $request->input('jobOrder');
        $requestItem->description = $request->input('description');
        $requestItem->cost = $request->input('cost');

//        $requestItem->quantity = 123;
//        $requestItem->measurement_id = 1;
//        $requestItem->job_order_id = 1;
//        $requestItem->description = 'test';
//        $requestItem->cost = 12;

        $requestItem->save();
    }

    public function removeItem($id){
        RequestItem::findOrFail($id)->delete();

        return ['message' => 'item deleted'];
    }

    public function addRequestItemImage(Request $request, $id){

        $images = [];

        foreach ($request->file('files') as $file) {

            $filename = $file->store('public');

            $requestImage = new RequestItemImage();
                $requestImage->file = $filename;
                $requestImage->request_item_id = $id;
                $requestImage->save();
                $images[] = $filename;
        }

        return ['images' =>  $images];
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
