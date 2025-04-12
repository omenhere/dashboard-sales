<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProfitController;



Route::resource('pricing', PricingController::class);
Route::resource('sale', SaleController::class);
Route::get('/sale/{id}/edit', [SaleController::class, 'edit'])->name('sale.edit');



Route::get('/sales/rekap', [SaleController::class, 'recapWithFilter'])->name('sales.rekap');
Route::get('/profit', [ProfitController::class, 'showProfit'])->name('profit.index');
Route::get('/pricing/{id}/edit', [PricingController::class, 'edit'])->name('pricing.edit');
Route::put('/pricing/{id}', [PricingController::class, 'update'])->name('pricing.update');



Route::get('/', function () {
    return view('welcome');
})->name('home');






