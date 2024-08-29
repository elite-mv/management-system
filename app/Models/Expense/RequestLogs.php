<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestLogs extends Model
{
    use HasFactory;


    protected  $fillable  = [
        'description',
        'user_id',
        'request_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function request(): BelongsTo{
        return $this->belongsTo(Request::class);
    }
}
