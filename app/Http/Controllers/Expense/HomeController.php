<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController
{

    public function index(){
        return view('expense.home');
    }
}
