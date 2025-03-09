<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'user_id' => rand(1, 10)
        ];
    }
    public function configure()
    {
        return $this->afterCreating(
            function (Order $order) {
                $products = \App\Models\Product::inRandomOrder()->take(3)->pluck('id');
                $order->products()->attach($products);
            }
        );
    }
}
