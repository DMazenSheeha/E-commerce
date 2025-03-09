<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Admin::factory()->create();
        User::factory()->count(30)->create();
        Category::factory()->count(30)->create();
        Product::factory()->count(30)->create();
        Order::factory()->count(30)->create();
    }
}
