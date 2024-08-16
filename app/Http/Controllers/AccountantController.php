<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;

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
