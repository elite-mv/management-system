<?php

namespace App\Http\Controllers\Expense;

use App\Actions\AddRequestLog;
use App\Models\Expense\RequestVat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VatController
{
    public function updatePurchaseOrder(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'purchase_order' => $request->input('purchaseOrder'),
                ]
            );

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }

    public function updateInvoice(Request $request, AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'invoice' => 'required',
            ]);

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'invoice' => $validated['invoice']
                ]
            );

            $addRequestLog->handle($requestID, 'Request Invoice was set to ' . $validated['invoice']);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }

    public function updateBill(Request $request,AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'bill' => 'required',
            ]);

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'bill' => $validated['bill'],
                ]
            );

            $addRequestLog->handle($requestID, 'Request Bill number was set to ' . $validated['bill']);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }
    public function updateOfficialReceipt(Request $request,AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'official_receipt' => 'required',
            ]);

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'official_receipt' => $validated['official_receipt'],
                ]
            );

            $addRequestLog->handle($requestID, 'Request Official Receipt was set to ' . $validated['official_receipt']);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }

    public function updateOptionA(Request $request, AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'option' => 'required',
            ]);

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'option_a' => $request->input('option'),
                ]
            );

            $addRequestLog->handle($requestID, 'Vat input Option A was set to ' . $validated['option']);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }
    public function updateOptionB(Request $request,AddRequestLog $addRequestLog, $requestID)
    {
        try {

            $validated = $request->validate([
                'option' => 'required',
            ]);

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'option_b' => $request->input('option'),
                ]
            );

            $addRequestLog->handle($requestID, 'Vat input Option B was set to ' . $validated['option']);

            DB::commit();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ],
                500
            );
        }
    }
}
