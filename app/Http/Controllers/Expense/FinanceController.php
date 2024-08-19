<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestPaymentStatus;
use App\Models\Expense\Request as ModelsRequest;

class FinanceController extends Controller
{
    public function  index()
    {
        return view('finance-requests', []);
    }

    public function getRequests()
    {
        $requests = ModelsRequest::where('priority', true)
        ->where('status', RequestPaymentStatus::PENDING->name)->get();

        return view('/partials/request-data', ['requests' => $requests]);
    }
}
