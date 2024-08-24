<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'bank_name_id',
        'bank_code_id',
        'check_number'
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(BankName::class, 'bank_name_id');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(BankCode::class, 'bank_code_id');
    }


}
