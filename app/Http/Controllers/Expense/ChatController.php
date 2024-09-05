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

    public function index()
    {

        $messages = Chat::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->take(200)
            ->get();

        return view('expense.chat', [
            'messages' => $messages,
        ]);
    }

    public function chatDetails()
    {
        try {
            $messages = Chat::with('user')
                ->where('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
                ->take(200)
                ->get();

            return view('expense.partials.chat-data', [
                'messages' => $messages,
            ]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function addMessage(Request $request)
    {

        try {

            DB::beginTransaction();

            $message = $request->input('message');

            Chat::create([
                'message' => $message,
                'user_id' => Auth::id(),
            ]);

            DB::commit();

            return response()->json(['message' => 'message sent']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'message failed'], 400);
        }
    }

}
