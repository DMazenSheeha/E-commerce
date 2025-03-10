<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DasboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('dashboard'));
Route::get('/dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');
Route::get("/products/search", [ProductController::class, 'searchByName'])->name("products.searchByName");
Route::resource("/products", ProductController::class);
Route::get("/products/search/{category}", [ProductController::class, 'searchByCategories'])->name("products.search");
Route::get("/categories/{category}/products", [CategoryController::class, 'products'])->name('categories.products');
Route::resource("/categories", CategoryController::class);
Route::get('/orders/info', [OrderController::class, 'ordersInfo'])->name('orders.info');
Route::resource("/orders", OrderController::class);
Route::get("/users/{user}/orders", [UserController::class, 'orders'])->name('users.orders');
Route::resource("/users", UserController::class);
Route::resource("/admins", AdminController::class);
