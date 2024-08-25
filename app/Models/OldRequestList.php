<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OldRequestList extends Model
{

    protected $fillable = [
        'email',
        'entity',
        'deyt',
        'supplier',
        'paid_to',
        'requested_by',
        'prepared_by',
        'total',
        'reference',
        'check_voucher',
        'bk_status',
        'bk_date',
        'acc_status',
        'acc_date',
        'fin_status',
        'fin_date',
        'aud_status',
        'aud_date',
        'payment_type',
        'terms',
        'check',
        'check2',
        'value',
        'value2',
        'bank_name',
        'account_name',
        'account_number',
        'bank_code',
        'check_number',
        'status',
    ];

    use HasFactory;


    public function requests(): HasMany
    {
        return $this->hasMany(OldRequest::class,'reference','reference');
    }
}
