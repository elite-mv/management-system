<?php

namespace App\Http\Controllers;

use App\Enums\RequestApprovalStatus;
use App\Enums\RequestPaymentStatus;
use App\Enums\RequestPriorityLevel;
use App\Models\Request as ModelsRequest;

class PresidentController extends Controller
{
    public function  index()
    {
        return view('president-requests', []);
    }

    public function getRequests()
    {
        $requests = ModelsRequest::where('priority', true)
        ->where('status', RequestPaymentStatus::PENDING->name)->get();

        return view('/partials/request-data', ['requests' => $requests]);
    }
}
