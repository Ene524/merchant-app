<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/items', [ItemController::class, 'index'])->name('item.index');
Route::post('/createOrUpdate', [ItemController::class, 'store'])->name('item.store');
Route::get('/edit', [ItemController::class, 'edit'])->name('item.edit');
Route::delete('/delete', [ItemController::class, 'delete'])->name('item.delete');

Route::get('/items/transactions/{id}', [ItemController::class, 'itemTransactions'])->name('item.transactions');
