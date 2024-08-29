<?php

namespace App\Http\Controllers\Expense;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class HomeController
{
    public function index(){
        return view('expense.home');
    }

}
