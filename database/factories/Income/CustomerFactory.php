<?php

namespace Database\Factories\Income;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'company' => fake()->company(),
            'email' => fake()->companyEmail(),
            'contact_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'position' => fake()->jobTitle(),
            'currency_id' => 1,
        ];
    }
}
