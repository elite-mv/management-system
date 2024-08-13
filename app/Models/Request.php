<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory;

    protected $fillabable = [
        'company_id',
        'supplier',
        'paid_to',
        'request_by',
        'prepared_by',
        'priority_level',
        'priority',
    ];

    protected $appends = ['total', 'reference'];

    public function getTotalAttribute(): float{
        return $this->items()->sum(DB::raw('quantity * cost'));
    }

    public function getReferenceAttribute(): string{
        return Carbon::createFromDate($this->created_at)->format('Ymd') .'-'. $this->id; 
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    
    }

    public function items(): HasMany{
        return $this->hasMany(RequestItem::class);
    }

}
