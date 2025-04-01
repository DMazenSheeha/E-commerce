<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DasboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('show.register');
    Route::get('/login', 'showLoginForm')->name('show.login');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});


Route::prefix('/u')->middleware('auth:web')->controller(FrontController::class)->group(function () {
    Route::get('/home', 'index')->name('front.index');
    Route::get('/shop', 'shop')->name('front.shop');
    Route::get('/contact', 'contact')->name('front.contact');
});

Route::prefix('/admin')->middleware('auth:admin')->group(function () {
    Route::get('/', [DasboardController::class, 'dashboard'])->name('dashboard');
    Route::get("/products/search", [ProductController::class, 'searchByName'])->name("products.searchByName");
    Route::resource("/products", ProductController::class);
    Route::get("/products/search/{category}", [ProductController::class, 'searchByCategories'])->name("products.search");
    Route::get("/categories/{category}/products", [CategoryController::class, 'products'])->name('categories.products');
    Route::resource("/categories", CategoryController::class);
    Route::get('admin/orders/info', [OrderController::class, 'ordersInfo'])->name('orders.info');
    Route::resource("/orders", OrderController::class);
    Route::get("/users/{user}/orders", [UserController::class, 'orders'])->name('users.orders');
    Route::resource("/users", UserController::class);
    Route::resource("/admins", AdminController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
