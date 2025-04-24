<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('home');
Route::controller(\App\Http\Controllers\CartController::class)->prefix('cart')->group(function () {
    Route::post('add', 'add');
    Route::get('/', 'index')->name('cart.index');
    Route::get('/total_items', 'totalItems');
});

Route::controller(\App\Http\Controllers\OrderController::class)->prefix('order')->group(function () {
    Route::post('checkout', 'checkout')->name('order.checkout');
});
