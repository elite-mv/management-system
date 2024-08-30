<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\RequestLogs;
use Illuminate\Http\Request;

class RequestLogsController
{

    public function index(Request $request)
    {

        $query = RequestLogs::query();

        $query->with('request');
        $query->with('user');

        $query->when($request->input('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('description', 'like', '%' . $request->input('search') . '%');

                $query->orWhereHas('request', function ($query) use ($request) {
                    $query->where('reference', 'like', '%' . $request->input('search') . '%');
                });

                $query->orWhereHas('user', function ($query) use ($request) {
                    $query->where('email', 'like', '%' . $request->input('search') . '%');
                    $query->orWhere('name', 'like', '%' . $request->input('search') . '%');
                });
            });
        });

        $query->orderBy('created_at', 'desc');
        $logs = $query->paginate(25);

        return view('expense.logs', [
            'logs' => $logs,
        ]);
    }
}
