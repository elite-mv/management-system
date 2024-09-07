<?php

namespace Database\Factories\Expense;

use App\Enums\AccountingAttachment;
use App\Enums\AccountingReceipt;
use App\Enums\AccountingType;
use App\Enums\PaymentMethod;
use App\Enums\RequestFundStatus;
use App\Enums\RequestPriorityLevel;
use App\Models\Expense\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense\Request>
 */
class RequestFactory extends Factory
{

    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'company_id' => 1,
            'supplier' => fake()->name(),
            'paid_to' => fake()->name(),
            'request_by' => fake()->name(),
            'prepared_by' => 1,
            'priority_level' => RequestPriorityLevel::MEDIUM->name,
            'priority' => 0,
            'payment_method' => PaymentMethod::CHECK->value,
            'attachment' => AccountingAttachment::WITH->name,
            'type' => AccountingType::OPEX->name,
            'receipt' => AccountingReceipt::DELIVERY_RECEIPT->name,
            'fund_status' => RequestFundStatus::FUNDED->value,
        ];

    }

}
