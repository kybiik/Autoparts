<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Головна сторінка
Route::get('/', [HomeController::class, 'index'])->name('home');

// Каталог товарів
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Категорії
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Кошик (доступний для всіх)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Обране (тільки для авторизованих)
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// Профіль користувача (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// роут для лічильника кошика
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');

// Адмін-панель (тільки для адміністраторів)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Головна сторінка адмінки
    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    })->name('dashboard');

    // Управління категоріями
    Route::resource('categories', AdminCategoryController::class);

    // Управління товарами
    Route::resource('products', AdminProductController::class);
    Route::delete('products/{image}/delete-image', [AdminProductController::class, 'deleteImage'])->name('products.delete-image');
});

// Авторизація (Laravel Breeze)
require __DIR__.'/auth.php';