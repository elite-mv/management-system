<?php

namespace App\Models\Income;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationList extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'start_date',
        'expiry_date',
        'subject',
        'unit',
        'discount',
        'shipping_charges',
        'currency',
        'email',
        'amount',
        'message'
    ];

    public function getReferenceAttribute(): string{
        return Carbon::createFromDate($this->start_date)->format('Ymd') .'-'. $this->getPadIdAttribute();
    }

    public function getPadIdAttribute(){
        return str_pad($this->id,3,"0",STR_PAD_LEFT);
    }
    
}
