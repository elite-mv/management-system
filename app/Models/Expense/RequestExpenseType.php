<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestExpenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_category_id',
        'request_id'
    ];
}
