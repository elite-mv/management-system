<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RequestExpenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_category_id',
        'request_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id','id');
    }

}
