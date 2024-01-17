<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_name' => $this->faker->word,
            'customer_id' => \App\Models\Customer::factory(),
            'currency' => $this->faker->randomElement(['NGN', 'USD']),
            'delivery_status' => $this->faker->randomElement(['confirmed', 'unconfirmed', 'pending']),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'payment_status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
