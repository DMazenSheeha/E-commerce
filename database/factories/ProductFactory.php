<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'desc' => fake()->paragraph(50),
            'price' => fake()->randomFloat(2, 10, 1000),
            'category_id' =>  rand(1, 10),
        ];
    }
}
