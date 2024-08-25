<?php

namespace App\Models\Expense;

use App\Enums\RequestApprovalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestApproval extends Model
{
    use HasFactory;

    protected $fillable = [
               'request_id',
               'role_id',
               'user_id',
               'status',
    ];

    protected $casts = [
        'status' => RequestApprovalStatus::class,
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }


}
