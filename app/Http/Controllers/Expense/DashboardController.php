<?php

namespace App\Http\Controllers\Expense;

class DashboardController
{

    public function index()
    {
        return view('expense.dashboard');
    }
}
