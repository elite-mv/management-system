<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;

class BookKeeperController extends Controller
{

    public function  index()
    {
        return view('book-keeper-requests', []);
    }

    public function getRequests()
    {
        $requests = ModelsRequest::whereDoesntHave('approvals', function($query) {
            $query->where('role_id', 1);
        })->where('priority', false)->get();

        return view('/partials/request-data', ['requests' => $requests]);
    }
}
