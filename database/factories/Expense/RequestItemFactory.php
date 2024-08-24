<?php

namespace Database\Factories\Expense;

use App\Enums\RequestItemStatus;
use App\Models\Expense\RequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense\RequestItem>
 */
class RequestItemFactory extends Factory
{

    protected $model = RequestItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(),
            'cost' => fake()->randomFloat(2,100,1000),
            'description' => fake()->text(),
            'measurement_id' => 1,
            'job_order_id' => 1,
            'status' => RequestItemStatus::PRIORITY->name,
            'session_id' => 1,
        ];
    }

}
