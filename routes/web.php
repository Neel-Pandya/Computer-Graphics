<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'create'])->name('admin.dashboard');
    Route::get('edit_profile', [AdminController::class, 'admin_edit'])->name('admin.edit');
    Route::get('change_password', [AdminController::class, 'change_password'])->name('admin.change.password');
    Route::post('update_pass', [AdminController::class, 'update_password'])->name('admin.password');
    Route::post('update', [AdminController::class, 'admin_update'])->name('admin.update');
    Route::view('login', 'pages.admin_login');
    Route::prefix('products')->group(function () {
        Route::get('avialable_products', [AdminController::class, 'products'])->name('products.available');
        Route::get('edit_products', [AdminController::class, 'products_edit'])->name('products.edit');
        Route::post('update', [AdminController::class, 'products_update'])->name('products.update');
        Route::get('add_product', [AdminController::class, 'products_add'])->name('products.add');
        Route::post('product_store', [AdminController::class, 'product_store'])->name('products.store');
        Route::get('purchased_products', [AdminController::class, 'products_purchase'])->name('products.purchase');
    });
    Route::prefix('category')->group(function () {
        Route::get('available_category', [AdminController::class, 'category_create'])->name('category.available');
        Route::get('category_add', [AdminController::class, 'category_add'])->name('category.add');
        Route::post('category_store', [AdminController::class, 'category_store'])->name('category.store');
        Route::get('category_edit', [AdminController::class, 'category_edit'])->name("category.edit");
        Route::post('category_update', [AdminController::class, 'category_update'])->name('category.update');
        Route::post('customer_store', [AdminController::class, 'customer_store'])->name('customers.store');
        Route::get('shoes', [AdminController::class, 'shoes'])->name('category.shoes');
        Route::get('shirt', [AdminController::class, 'shirt'])->name('category.shirt');
        Route::get('jeans', [AdminController::class, 'jeans'])->name('category.jeans');
        Route::get('hoodie', [AdminController::class, 'hoodie'])->name('category.hoodie');
    });

    Route::prefix('customers')->group(function () {
        Route::get('customer_details', [AdminController::class, 'customer_create'])->name('customers.details');
        Route::get('add', [AdminController::class, 'customer_add'])->name('customers.add');
        Route::get('customer_edit', [AdminController::class, 'customer_edit'])->name('customer.edit');
        Route::post('customer_update', [AdminController::class, 'customer_update'])->name('customer.update');
    });

    Route::prefix('gender')->group(function () {
        Route::get('male', [AdminController::class, 'products_male'])->name('gender.male');

        Route::get('female', [AdminController::class, 'products_female'])->name('gender.female'); 
    });

    Route::get('rating', [AdminController::class, 'rate'])->name('rate');
    Route::post('login', [AdminController::class, 'login'])->name('login'); 
});
