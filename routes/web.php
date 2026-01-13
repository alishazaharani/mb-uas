<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\SuperUserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{id}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/search', [ProductController::class, 'search'])
    ->name('search');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED (ALL ROLES)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:user'])->group(function () {

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CoController::class, 'index'])->name('index');
        Route::post('/store', [CoController::class, 'store'])->name('store');
        Route::get('/history', [CoController::class, 'history'])->name('history');
    });

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

    
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [AdminKategoriController::class, 'index'])->name('index');
        Route::post('/store', [AdminKategoriController::class, 'store'])->name('store');
        Route::patch('/update/{id}', [AdminKategoriController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminKategoriController::class, 'destroy'])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::patch('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminUserController::class, 'destroy'])->name('delete');
    });

    Route::prefix('pesanan')->name('pesanan.')->group(function () {
        Route::get('/', [PesananController::class, 'index'])->name('index');
        Route::patch('/update-status/{id}', [PesananController::class, 'updateStatus'])->name('updateStatus');
    });
});
/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');

    Route::prefix('superadmin/users')->name('superadmin.users.')->group(function () {
        Route::get('/', [SuperUserController::class, 'index'])->name('index');
        Route::post('/users', [SuperUserController::class, 'store'])->name('store');
        Route::patch('/update/{id}', [SuperUserController::class, 'update'])->name('update');
        Route::delete('/users/{id}', [SuperUserController::class, 'destroy'])->name('delete');
    });
});

/*
|--------------------------------------------------------------------------
| AUTH (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';