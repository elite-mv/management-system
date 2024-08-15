<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class BookKeeperController extends Controller
{

    public function  index()
    {

        ModelsRequest::with('approvals', function($query){
            $query->whereNull('user_role', null);
        });

        return view('entity', []);
    }
}
