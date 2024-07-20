<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'welcome']);

Route::get('/signin', [HomeController::class, 'sign_in'])->name('login');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth');

Route::post('/sales', [HomeController::class, 'store_sales'])->middleware('auth');

Route::get('/single-product/{id}', [HomeController::class, 'single_product'])->name('single-product')->middleware('auth');

Route::delete('/sales/delete/{sale}', [HomeController::class, 'delete_sale_record'])->middleware('auth');

Route::put('/sales/edit-sale/{sale}', [HomeController::class, 'edit_sale'])->middleware('auth');

Route::post('/authenticate', [HomeController::class, 'authentication']);

Route::post('/logout', [HomeController::class, 'invalidate'])->middleware('auth');

Route::get('/import-product', [HomeController::class, 'import_product'])->middleware('auth');

Route::post('/products', [HomeController::class, 'store_products'])->middleware('auth');

Route::get('/single-import/{id}', [HomeController::class, 'single_import_product'])->name('single-import')->middleware('auth');

Route::delete('/delete-product/{product}', [HomeController::class, 'delete_product'])->middleware('auth');