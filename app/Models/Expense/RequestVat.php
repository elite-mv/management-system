<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestVat extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order',
        'invoice',
        'bill',
        'official_receipt',
        'request_id',
        'option_a',
        'option_b',
    ];
}
