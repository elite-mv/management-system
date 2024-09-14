<?php

namespace App\Http\Controllers\Expense;

use Illuminate\Http\Request;
use App\Actions\AddRequestLog;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\PaymentImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentUploadsController
{
    public function addPaymentUpload(Request $request, AddRequestLog $addRequestLog, $requestID)
    {

        try {

            $validated = $request->validate([
                'files.*' => 'required|mimes:jpg,jpeg,png,pdf',
            ]);

            DB::beginTransaction();

            $image = [];

            foreach ($request->file('files') as $file) {

                $filename = $file->store('public');

                if(!$filename){
                    throw new \Exception('Unable to store image');
                }

                $requestImage = new PaymentImage();
                $requestImage->file = $filename;
                $requestImage->request_id = $requestID;
                $requestImage->save();

                $image = $requestImage;
            }

            $addRequestLog->handle($requestID, 'payment attachment was uploaded by ' . Auth::user()->name);

            DB::commit();

            return response()->json($image);
        } catch (\Exception $e) {

            DB::beginTransaction();

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
