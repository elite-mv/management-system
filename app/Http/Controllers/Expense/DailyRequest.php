<?php

namespace App\Http\Controllers\Expense;

use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyRequest
{
    public function index(Request $request)
    {

        $query = \App\Models\Expense\Request::query();

        $query->with('company');
        $query->with('preparedBy');

        $query->whereHas('approvals', function ($query) use ($request) {

            $query->where('updated_at', '>=', Carbon::now()->startOfDay()->format('Y-m-d H:i:s'));
            $query->where('updated_at', '<=', Carbon::now()->endOfDay()->format('Y-m-d H:i:s'));

            $query->where('status', RequestApprovalStatus::APPROVED->name);

            $query->whereHas('role', function ($query) {
                $query->whereIn('name', [UserRole::PRESIDENT->value, UserRole::FINANCE->value]);
            });
        });

        return view('expense.daily-requests', [
            'requests' => $query->paginate(25),
        ]);
    }
}
