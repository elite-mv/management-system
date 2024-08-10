<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'cost',
        'description',
        'measurement_id',
        'job_order_id',
        'session_id',
        'request_id',
    ];

    protected $appends = ['total'];

    public function getTotalAttribute(): float{
        return $this->quantity * $this->cost;
    }

    public function jobOrder(): BelongsTo
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function measurement(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }

}
