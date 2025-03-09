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
Route::resource("/categories", CategoryController::class);
Route::resource("/orders", OrderController::class);
Route::resource("/users", UserController::class);
Route::resource("/admins", AdminController::class);
