<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            'name' => 'Osama',
            'email' => 'osama@admin.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
