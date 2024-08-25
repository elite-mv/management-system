<?php

namespace App\Http\Controllers\Expense;

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

    public function updateInvoice(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'invoice' => $request->input('invoice'),
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

    public function updateBill(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'bill' => $request->input('bill'),
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
    public function updateOfficialReceipt(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'official_receipt' => $request->input('receipt'),
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

    public function updateOptionA(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'option_a' => $request->input('option'),
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
    public function updateOptionB(Request $request, $requestID)
    {
        try {

            DB::beginTransaction();

            RequestVat::updateOrCreate( ['request_id' => $requestID ],
                [
                    'option_b' => $request->input('option'),
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
}
