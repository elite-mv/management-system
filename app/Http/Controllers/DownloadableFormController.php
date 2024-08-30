<?php

namespace App\Http\Controllers;

use App\Enums\RequestApprovalStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense\Request as ExpenseRequest;

class DownloadableFormController
{
    public function index()
    {

        $requests = ExpenseRequest::with('company')
            ->with('items')
            ->with('bookKeeper', function ($query) {
                $query->where(function ($query) {
                    $query->where('status', RequestApprovalStatus::APPROVED->name);
                    $query->with('role', function ($query) {
                        $query->where('name', UserRole::BOOK_KEEPER->value);
                    });
                });
            })
            ->with('accountant', function ($query) {
                $query->where(function ($query) {
                    $query->where('status', RequestApprovalStatus::APPROVED->name);
                    $query->with('role', function ($query) {
                        $query->where('name', UserRole::ACCOUNTANT->value);
                    });
                });
            })
            ->with('finance', function ($query) {
                $query->where(function ($query) {
                    $query->where('status', RequestApprovalStatus::APPROVED->name);
                    $query->with('role', function ($query) {
                        $query->where('name', UserRole::FINANCE->value);
                    });
                });
            })
            ->with('auditor', function ($query) {
                $query->where(function ($query) {
                    $query->where('status', RequestApprovalStatus::APPROVED->name);
                    $query->with('role', function ($query) {
                        $query->where('name', UserRole::AUDITOR->value);
                    });
                });
            })
            ->paginate(20);

        return view('expense.downloadable-forms', [
            'requests' => $requests,
        ]);
    }
}
