<?php

namespace App\Http\Controllers\Expense;
use App\Models\Expense\RequestComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestCommentController
{

    public function viewComments($requestID)
    {
        $comments = RequestComment::where('request_id',$requestID)->get();

        return view('expense.partials.request-comments', ['comments' => $comments]);
    }

    public function addComment(Request $request, $requestID){

        try{
            DB::beginTransaction();

            RequestComment::create([
                'user_id' => Auth::id(),
                'request_id' => $requestID,
                'message' => $request->input('message'),
            ]);

            DB::commit();
        }catch(\Exception $exception){
            DB::rollBack();
        } finally {
            return redirect()->route('comments', ['requestID' => $requestID]);
        }
    }

}
