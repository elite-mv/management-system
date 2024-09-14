<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestItemStatus;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use App\Models\Expense\RequestItem;
use App\Models\Expense\RequestItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestItemController extends Controller
{

    public function addRequestItem(Request $request)
    {

        try {
            $validated = $request->validate([
                'measurement' => 'required',
                'jobOrder' => 'required',
                'quantity' => 'required|numeric|min:1',
                'cost' => 'required',
                'description' => 'required',
            ]);

            DB::beginTransaction();

            $requestItem = new RequestItem();
            $measurement = Measurement::where('id', $validated['measurement'])->firstOrFail();
            $jobOrder = JobOrder::where('id', $validated['jobOrder'])->firstOrFail();

            $requestItem->quantity = $validated['quantity'];
            $requestItem->cost = $validated['cost'];
            $requestItem->description = $validated['description'];

            $requestItem->measurement_id = $measurement->id;
            $requestItem->job_order_id = $jobOrder->id;
            $requestItem->session_id = Session::getId();

            $requestItem->save();

            DB::commit();

            return response()->json(['message' => 'item added']);

        } catch (\Exception $exception) {
            DB::rollBack();
//            return response()->json(['message' => 'failed in adding item'], 500);
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function updateRequestItem(Request $request, RequestItem $requestItem)
    {

        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'measurement' => 'required',
                'jobOrder' => 'required',
                'quantity' => 'required|numeric|min:1',
                'cost' => 'required',
                'description' => 'required',
                'remarks' => 'nullable',
                'status' => 'nullable',
            ]);

            $requestItem->measurement_id = $validated['measurement'];
            $requestItem->job_order_id = $validated['jobOrder'];

            $requestItem->quantity = $validated['quantity'];
            $requestItem->cost = $validated['cost'];
            $requestItem->description = $validated['description'];

            if ($request->input('remarks')) {
                $requestItem->remarks = $validated['remarks'];
            }

            if ($request->input('status')) {
                $requestItem->status = RequestItemStatus::valueOf($validated['status'])->name;
            }

            $requestItem->save();

            Db::commit();

            return redirect()->back();

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => 'Failed to update item']);
        }

    }

    public function getRequestItems()
    {

        try {

            $requestItems = RequestItem::where('session_id', Session::getId())
                ->whereNull('request_id')->get();

            return view('expense.partials.request-cart', [
                'requestItems' => $requestItems,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getRequestItem($id)
    {

        try {
            $requestItem = RequestItem::with('attachments')
                ->findOrFail($id);

            return response()->json($requestItem);

        } catch (\Exception $exception) {
            return response()->json(['message' => 'unable to fetch request item'], 400);
        }

    }

    public function updateItem(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validate([
                'quantity' => 'required',
                'measurement' => 'required',
                'jobOrder' => 'required',
                'description' => 'required',
                'cost' => 'required',
            ]);

            //check first if the item is present
            $requestItem = RequestItem::findOrFail($id);

            $requestItem->quantity = $validated['quantity'];
            $requestItem->measurement_id = $validated['measurement'];
            $requestItem->job_order_id = $validated['jobOrder'];
            $requestItem->description = $validated['description'];
            $requestItem->cost = $validated['cost'];

            $requestItem->save();

            DB::commit();

            return response()->json(['message' => 'item updated']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'item updated'], 500);
        }
    }

    public function removeItem($id)
    {
        try {

            DB::beginTransaction();

            $item = RequestItem::findOrFail($id);

            $item->delete();

            DB::commit();

            return response()->json(['message' => 'item deleted']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function addRequestItemImage(Request $request, $id)
    {

        try {

            $validated = $request->validate([
                'files.*' => 'required|mimes:jpg,jpeg,png,pdf',
            ]);

            $images = [];

            DB::beginTransaction();

            foreach ($request->file('files') as $file) {

                $filename = $file->store('public');

                if(!$filename){
                    throw new \Exception('Unable to store image');
                }

                $requestImage = new RequestItemImage();
                $requestImage->file = $filename;
                $requestImage->request_item_id = $id;
                $requestImage->save();
                $images[] = $filename;
            }

            DB::commit();

            return response()->json(['images' => $images]);
        } catch (\Exception $e) {

            DB::beginTransaction();

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getRequestTotal()
    {
        $total = DB::table('request_items')
            ->select(DB::raw('SUM(quantity * cost) as total'))
            ->where('session_id', '=', Session::getId())
            ->whereNull('request_id')
            ->first();

        return $total ?? 0;
    }
}
