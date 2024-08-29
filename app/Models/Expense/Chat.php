<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id'
    ];


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
