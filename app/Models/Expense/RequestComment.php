<?php

namespace App\Models\Expense;

use App\Enums\RequestCommentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestComment extends Model
{
    use HasFactory;

    protected  $fillable = [
        'request_id',
        'type',
        'message',
        'user_id',
    ];

    protected  $casts = [
        'type'  => RequestCommentType::class,
    ];


    function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}
