<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DasboardController extends Controller
{
    public function dashboard()
    {
        $productsCount = Product::count();
        $adminsCount = Admin::count();
        $ordersCount = Order::count();
        $usersCount = User::count();
        return view('dashboard.index', compact('usersCount', 'adminsCount', 'productsCount', 'ordersCount'));
    }
}
