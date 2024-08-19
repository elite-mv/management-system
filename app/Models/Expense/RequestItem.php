<?php

namespace App\Models\Expense;

use App\Enums\RequestItemStatus;
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
        'status',
    ];

    protected $appends = ['total', 'fund'];

    public function getTotalAttribute(): float{
        return $this->quantity * $this->cost;
    }

    public function getFundAttribute(): float{

        if($this->status == RequestItemStatus::APPROVED->name || $this->status == RequestItemStatus::PRIORITY->name ){
            return $this->quantity * $this->cost;
        }

        return 0;
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
