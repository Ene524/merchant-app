<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::post('/createOrUpdate', [ItemController::class, 'store'])->name('item.store');
    Route::get('/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::delete('/delete', [ItemController::class, 'delete'])->name('item.delete');

    Route::get('/items/transactions/{id}', [ItemController::class, 'itemTransactions'])->name('item.transactions');
    Route::post('/items/transactions/createOrUpdate', [ItemController::class, 'transactionStore'])->name('item.transactionStore');
    Route::get('/editTransaction', [ItemController::class, 'editTransaction'])->name('transaction.edit');


    Route::prefix('user')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('create', [UserController::class, 'store']);
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('delete', [UserController::class, 'delete'])->name("user.delete");
    });

    Route::get('/logout', [AuthController::class, "logout"])->name("user.logout");
});

Route::get('/user/login', [AuthController::class, "showLogin"])->name("user.login");
Route::post('/user/login', [AuthController::class, "login"]);
