<?php

namespace App\Models\Expense;

use App\Enums\RequestApprovalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountantApproval extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'user_id',
        'status',
    ];

    protected  $casts = [
        'status' => RequestApprovalStatus::class
    ];

}
