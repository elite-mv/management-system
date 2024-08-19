<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'completed',
        'supplier_verified',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'supplier_verified' => 'boolean',
    ];

}
