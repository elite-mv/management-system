<?php

namespace App\Http\Controllers;

use App\Models\Expense\BankCode;
use App\Models\Expense\BankName;
use App\Models\Expense\ExpenseCategory;
use App\Models\Expense\JobOrder;
use App\Models\Expense\Measurement;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense\Request as ExpenseRequest;

class NavigationController
{
    public function index()
    {
        return view('navigation');
    }

    public function pin()
    {
        return view('pin');
    }

    public function verifyPin(Request $request)
    {
        session(['pin_verified' => true]);
        return redirect('/navigation');
    }
}
