<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::put('/{id}', [ProductController::class, 'update'])->whereNumber('id')->name('product.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->whereNumber('id')->name('product.destroy');
    Route::get('/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('product.show');
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
});

Route::prefix('sales')->group(function () {
    Route::post('/', [SaleController::class, 'store'])->name('sale.store');
    Route::patch('/add-item/{id}', [SaleController::class, 'addItem'])->whereNumber('id')->name('sale.add.item');
    Route::patch('/cancel/{id}', [SaleController::class, 'cancelSale'])->whereNumber('id')->name('sale.cancel');
    Route::get('/{id}', [SaleController::class, 'show'])->whereNumber('id')->name('sale.show');
    Route::get('/', [SaleController::class, 'index'])->name('sale.index');
});
