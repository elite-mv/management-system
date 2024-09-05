<?php

namespace App\Http\Controllers\Expense;

use App\Jobs\Expense\ChatAlertJob;
use App\Mail\Expense\ChatAlert;
use App\Models\Expense\RequestComment;
use App\Models\Expense\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RequestCommentController
{

    public function viewComments($requestID)
    {
        try {
            $comments = RequestComment::where('request_id', $requestID)
                ->with('user')
                ->get();

            return view('expense.partials.request-comments', ['comments' => $comments]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'unable to load comments'], 500);
        }
    }

    public function addComment(Request $request, $requestID)
    {

        try {

            $validated = $request->validate([
                'message' => 'required'
            ]);

            DB::beginTransaction();

            $comment = RequestComment::create([
                'user_id' => Auth::id(),
                'request_id' => $requestID,
                'message' => $validated['message'],
            ]);

            ChatAlertJob::dispatch($comment);

            DB::commit();

            return response()->json(['message' => 'ok']);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'unable to add comment'], 500);
        }
    }

}
