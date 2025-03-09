<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::get("/products/search", [ProductController::class, 'searchByName'])->name("products.searchByName");
Route::resource("/products", ProductController::class);
Route::get("/products/search/{category}", [ProductController::class, 'searchByCategories'])->name("products.search");
Route::get("/categories/{category}/products", [CategoryController::class, 'products'])->name('categories.products');
Route::resource("/categories", CategoryController::class);
Route::resource("/orders", OrderController::class);
Route::get("/users/{user}/orders", [UserController::class, 'orders'])->name('users.orders');
Route::resource("/users", UserController::class);
Route::resource("/admins", AdminController::class);
