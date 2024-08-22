<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestStatus;
use App\Models\Expense\Request as ModelsRequest;

class AccountantController extends Controller
{
    public function  index()
    {
        return view('expense.accountant-requests', []);
    }

    public function getRequests()
    {

        $requests = ModelsRequest::where('priority', false)
            ->doesntHave('accountantApproval')
            ->where(function ($query) {
                $query->orWhere('status', RequestStatus::PENDING->name);
            })->get();

        return view('expense.partials.request-data', ['requests' => $requests]);
    }
}
