<?php

namespace App\Http\Controllers\Expense;

use App\Events\ChatEvent;
use App\Models\Expense\Chat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController
{

    public function index(){

        $messages = Chat::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->take(200)
            ->get();

        return view('expense.chat', [
            'messages' => $messages,
        ]);
    }

    public function addMessage(Request $request){

        try {

            DB::beginTransaction();

            $message = $request->input('message');

             Chat::create([
                'message' => $message,
                'user_id' => Auth::id(),
            ]);

            event(new ChatEvent([
                'message' => $message,
                'user_id' => Auth::id(),
            ]));

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
    }

    public function test(){

        try {
            event(new ChatEvent('test'));
        }catch (\Exception $e){
            DB::rollBack();
        }
    }

}
