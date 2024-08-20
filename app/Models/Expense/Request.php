<?php

namespace App\Models\Expense;

use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\PaymentMethod;
use App\Enums\RequestItemStatus;
use App\Enums\RequestPriorityLevel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'supplier',
        'paid_to',
        'request_by',
        'prepared_by',
        'priority_level',
        'priority',
        'payment_method',
        'attachment',
        'type',
        'receipt',
    ];

    protected $appends = ['total', 'reference', 'fund', 'fund_item'];
    protected function casts(): array
    {
        return [
            'priority_level' => RequestPriorityLevel::class,
            'payment_method' => PaymentMethod::class,
            'attachment' => AccountingAttachment::class,
            'type' => AccountingType::class,
            'receipt' => AccountingReceipt::class,
        ];
    }

    public function getTotalAttribute(): float{
        return $this->items()->sum(DB::raw('quantity * cost'));
    }

    public function getFundAttribute(): float{
        return $this->items()
        ->whereIn('status', [
            RequestItemStatus::APPROVED->name,
            RequestItemStatus::PRIORITY->name
        ])
        ->sum(DB::raw('quantity * cost'));
    }

    public function getReferenceAttribute(): string{
        return Carbon::createFromDate($this->created_at)->format('Ymd') .'-'. $this->getPadIdAttribute();
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);

    }

    public function items(): HasMany{
        return $this->hasMany(RequestItem::class);
    }

    public function approvals(): HasMany{
        return $this->hasMany(RequestApproval::class);
    }

    public function preparedBy(): BelongsTo{
        return $this->belongsTo(User::class,'prepared_by');
    }

    public function checkVoucher(): HasOne{
        return $this->hasOne(CheckVoucher::class);
    }
    public function accountingDetail(): HasOne{
        return $this->hasOne(AccountingDetail::class);
    }
    public function getFundItemAttribute(){
        return $this->items()
        ->whereIn('status', [
            RequestItemStatus::APPROVED->name,
            RequestItemStatus::PRIORITY->name
        ])->get();
    }

    public function getPadIdAttribute()
    {
        return str_pad($this->id,3,"0",STR_PAD_LEFT);
    }

}
