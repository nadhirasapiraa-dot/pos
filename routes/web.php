<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;


Route::get('/', function () {
    return redirect()->route('login');
});

// Akses untuk belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});

// Akses sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Khusus Admin (Users & Kategori)
    Route::middleware('role:admin')->group(function () {
        // Group untuk Users dengan prefix admin
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // Kategori dipindah ke sini agar hanya bisa diakses Admin
        Route::resource('/kategori', KategoriController::class);
    });

    // Khusus Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('/produk', ProdukController::class);
        Route::resource('/penjualan', PenjualanController::class);
        Route::resource('/itempenjualan', ItemPenjualanController::class); 
    });

    Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

});