<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;


Route::get('/', [ProductController::class, 'index'])->name('products.home');
Route::get('/categories', [ProductController::class, 'categories'])->name('products.categories');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/all-products', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/api/products', [ProductController::class, 'getProductsByTag']);

Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

