<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DasboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirectIfAuthenticated')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('show.register');
    Route::get('/login', 'showLoginForm')->name('show.login');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('auth:web')->group(function () {
    Route::prefix('/u')->group(function () {
        Route::get('/home', [FrontController::class, 'index'])->name('home');
        Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
        Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
        Route::get('/shop/search', [ShopController::class, 'productsByName'])->name('shop.search');
        Route::get('/shop/{category}', [ShopController::class, 'productsByCategory'])->name('shop.productsByCategory');
        Route::get('/shop/{productId}/details', [ShopController::class, 'show'])->name('shop.show');
    });
    Route::fallback(function () {
        return redirect('/u/home');
    });
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('/admin')->group(function () {
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
    Route::fallback(function () {
        return redirect('/admin');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
