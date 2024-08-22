<?php

namespace App\Models\Expense;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CheckVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id'
    ];

    public function getPadIdAttribute()
    {
        return str_pad($this->id,3,"0",STR_PAD_LEFT);
    }

    public function getReferenceAttribute(): string{
        return Carbon::createFromDate($this->created_at)->format('Ymd') .'-'. $this->getPadIdAttribute();
    }

}
