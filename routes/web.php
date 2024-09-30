<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('products.home');
Route::get('/categories', [ProductController::class, 'categories'])->name('products.categories');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/all-products', [ProductController::class, 'allProducts'])->name('products.all');
