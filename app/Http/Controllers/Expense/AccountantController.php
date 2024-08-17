<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Request as ModelsRequest;

class AccountantController extends Controller
{
    public function  index()
    {
        return view('accountant-requests', []);
    }

    public function getRequests()
    {
        $requests = ModelsRequest::whereDoesntHave('approvals', function($query) {
            $query->where('role_id', 2);
        })->where('priority', false)->get();

        return view('/partials/request-data', ['requests' => $requests]);
    }
}
