<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('dashboard');
Route::controller(\App\Http\Controllers\CartController::class)->prefix('cart')->group(function () {
    Route::post('add', 'add');
    Route::get('/', 'index')->name('cart.index');
    Route::put('/update', 'update');
    Route::get('/total_items', 'totalItems');
    Route::delete('/remove', 'remove');
});

Route::middleware('auth')->controller(\App\Http\Controllers\OrderController::class)->prefix('order')->group(function () {
    Route::post('checkout', 'checkout')->name('order.checkout');
    Route::get('/', 'index')->name('order.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
