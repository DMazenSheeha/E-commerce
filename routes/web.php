<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DasboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('front.index');
    })->name('front.index');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', [DasboardController::class, 'dashboard'])->name('dashboard');
    Route::get("/admin/products/search", [ProductController::class, 'searchByName'])->name("products.searchByName");
    Route::resource("/admin/products", ProductController::class);
    Route::get("/admin/products/search/{category}", [ProductController::class, 'searchByCategories'])->name("products.search");
    Route::get("/admin/categories/{category}/products", [CategoryController::class, 'products'])->name('categories.products');
    Route::resource("/admin/categories", CategoryController::class);
    Route::get('/orders/info', [OrderController::class, 'ordersInfo'])->name('orders.info');
    Route::resource("/admin/orders", OrderController::class);
    Route::get("/admin/users/{user}/orders", [UserController::class, 'orders'])->name('users.orders');
    Route::resource("/admin/users", UserController::class);
    Route::resource("/admin/admins", AdminController::class);
});

Route::middleware('guest:admin')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('show.register');
    Route::get('/login', 'showLoginForm')->name('show.login');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
