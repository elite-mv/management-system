<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'company',
        'email',
        'contact_number',
        'address',
        'currency_id'
    ];

    public function currency(): HasOne{
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function clientOf(): HasMany
    {
        return $this->HasMany(SalesOfficerClient::class, 'customer_id', 'id');
    }

}
