<?php

namespace App\Models\Expense;

use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\PaymentMethod;
use App\Enums\RequestApprovalStatus;
use App\Enums\RequestFundStatus;
use App\Enums\RequestItemStatus;
use App\Enums\RequestPriorityLevel;
use App\Enums\RequestStatus;
use App\Enums\UserRole;
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
        'fund_status',
        'reference',
        'released_by',
        'received_by',
        'audited_by',
        'status',
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
            'status' => RequestStatus::class,
            'fund_status' => RequestFundStatus::class,
        ];
    }

    protected static function booted()
    {
        static::created(function ($request) {
            $request->reference = $request->created_at->format('Ymd') . '-' . str_pad($request->id, 3, "0", STR_PAD_LEFT);;
            $request->save();
        });
    }

    public function getTotalAttribute(): float
    {
        return $this->items()->sum(DB::raw('quantity * cost'));
    }

    public function getFundAttribute(): float
    {
        return $this->items()
            ->whereIn('status', [
                RequestItemStatus::APPROVED->name,
                RequestItemStatus::PRIORITY->name
            ])
            ->sum(DB::raw('quantity * cost'));
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(RequestItem::class);
    }

    public function approvedItems(): HasMany
    {
        return $this->hasMany(RequestItem::class);
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(RequestApproval::class);
    }

    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    public function checkVoucher(): HasOne
    {
        return $this->hasOne(CheckVoucher::class);
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(RequestDelivery::class);
    }

    public function bankDetails(): HasOne
    {
        return $this->hasOne(BankDetail::class);
    }

    public function expenseTypes(): HasMany
    {
        return $this->hasMany(RequestExpenseType::class);
    }

    public function accountingDetail(): HasOne
    {
        return $this->hasOne(AccountingDetail::class);
    }

    public function bookKeeper(): HasOne
    {
        return $this->hasOne(RequestApproval::class);
    }

    public function finance(): HasOne
    {
        return $this->hasOne(RequestApproval::class);
    }

    public function auditor(): HasOne
    {
        return $this->hasOne(RequestApproval::class);
    }

    public function accountant(): HasOne
    {
        return $this->hasOne(RequestApproval::class);
    }

    public function vat(): HasOne
    {
        return $this->hasOne(RequestVat::class);
    }

    public function getFundItemAttribute()
    {
        return $this->items()
            ->whereIn('status', [
                RequestItemStatus::APPROVED->name,
                RequestItemStatus::PRIORITY->name
            ])->get();
    }

    public function getPadIdAttribute()
    {
        return str_pad($this->id, 3, "0", STR_PAD_LEFT);
    }

    public function getTimeLapseAttribute(): float
    {
        $start = Carbon::parse($this->created_at);
        $end = Carbon::now();
//
//        $days = $start->diffInDays($end);
        $hours = (int)$start->diffInHours($end);
//        $minutes = $start->diffInMinutes($end) - ($hours * 60) - ($days * 24 * 60);
//
//        return $days + $hours / 24 + $minutes / 1440;

        return $hours;
    }



    public function getRequestStatusAttribute()
    {

        $approvedCount = $this->approvals()
            ->whereHas('role', function ($qb) {
                $approvedRoles = [
                    UserRole::BOOK_KEEPER->value,
                    UserRole::ACCOUNTANT->value,
                    UserRole::FINANCE->value,
                    UserRole::AUDITOR->value,
                ];

                $qb->whereIn('name', $approvedRoles)
                    ->where('status', RequestApprovalStatus::APPROVED);
            })
            ->count();

        return $approvedCount >= 4 ? 'CLOSE' : 'OPEN';
    }

}
