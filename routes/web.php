<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WitelController;
use App\Http\Controllers\StoController;
use App\Http\Controllers\BundlingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Witel
Route::resource('witels', WitelController::class);

// STO
Route::resource('stos', StoController::class);

// Bundling
Route::resource('bundlings', BundlingController::class);

// Product
Route::resource('products', ProductController::class);

// Product Pricing
Route::resource('product-prices', ProductPriceController::class);

// Sale
Route::resource('sales', SaleController::class);