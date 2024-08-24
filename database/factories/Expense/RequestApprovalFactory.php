<?php

namespace Database\Factories\Expense;

use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense\RequestApproval>
 */
class RequestApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => 2,
            'user_id' => 1,
            'status' => RequestStatus::PENDING->value,
        ];
    }
}
