<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Master\ProductController;
use App\Http\Controllers\API\Transaction\OrderController;
use App\Http\Controllers\API\DashboardController;

// Health check
Route::get('test', fn() => response()->json([
    'code'    => 200,
    'message' => 'API is running',
]));

// Soal 1 — GET Daftar Produk Aktif
Route::get('products', [ProductController::class, 'index']);

// Soal 2 — POST Order
Route::post('orders', [OrderController::class, 'store']);

// Soal 3 — Dashboard Analytics
Route::get('dashboard/summary', [DashboardController::class, 'summary']);
Route::delete('dashboard/cache', [DashboardController::class, 'flushCache']);

// Bonus — Scoped Binding: order harus milik user tersebut
Route::get('users/{user}/orders/{order}', [OrderController::class, 'showUserOrder'])
    ->scopeBindings();
