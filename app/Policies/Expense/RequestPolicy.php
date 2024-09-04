<?php

namespace App\Policies\Expense;

use App\Enums\UserRole;
use App\Models\Expense\Request;
use App\Models\Expense\User;

class RequestPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function bookerKeeperApproval(User $user)
    {
        return $user->role->name == UserRole::BOOK_KEEPER->value;
    }

    public function accountingApproval(User $user)
    {
        return $user->role->name == UserRole::ACCOUNTANT->value || $user->role->name == UserRole::PRESIDENT->value;
    }

    public function financeApproval(User $user)
    {
        return $user->role->name == UserRole::FINANCE->value || $user->role->name == UserRole::PRESIDENT->value;
    }

    public function auditorApproval(User $user)
    {
        return $user->role->name == UserRole::AUDITOR->value || $user->role->name == UserRole::PRESIDENT->value;
    }

}
