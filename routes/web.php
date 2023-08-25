<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
    Route::view('login', 'pages.admin_login')
        ->name('admin.login')
        ->middleware('Auth.success');
    Route::post('login_validate', [AdminController::class, 'login'])->name('login.validate');


    // Authentication using middleware 

    Route::middleware('Auth.admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'create'])->name('admin.dashboard');
        Route::get('edit_profile', [AdminController::class, 'admin_edit'])->name('admin.edit');
        Route::get('change_password', [AdminController::class, 'change_password'])->name('admin.change.password');
        Route::post('update_pass', [AdminController::class, 'update_password'])->name('admin.password');
        Route::post('update', [AdminController::class, 'admin_update'])->name('admin.update');
        Route::get('logout', [AdminController::class, 'admin_logout'])->name('admin.logout'); 

        Route::prefix('products')->group(function () {
            Route::get('avialable_products', [AdminController::class, 'products'])->name('products.available');
            Route::get('edit', [AdminController::class, 'products_edit'])->name('products.edit');
            Route::post('update', [AdminController::class, 'products_update'])->name('products.update');
            Route::get('add_product', [AdminController::class, 'products_add'])->name('products.add');
            Route::post('product_store', [AdminController::class, 'product_store'])->name('products.store');
            Route::get('purchased_products', [AdminController::class, 'products_purchase'])->name('products.purchase');
        });

        Route::prefix('category')->group(function () {
            Route::get('available_category', [AdminController::class, 'category_create'])->name('category.available');
            Route::get('category_add', [AdminController::class, 'category_add'])->name('category.add');
            Route::post('category_store', [AdminController::class, 'category_store'])->name('category.store');
            Route::get('category_edit', [AdminController::class, 'category_edit'])->name('category.edit');
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

        Route::prefix('coupens')->group(function () {
            Route::get('available', [AdminController::class, 'coupen_available'])->name('coupen.here');
            Route::get('used', [AdminController::class, 'coupen_used'])->name('coupen.used');
            Route::get('add', [AdminController::class, 'coupen_add'])->name('coupen.add');
            Route::get('edit', [AdminController::class, 'coupen_edit'])->name('coupen.edit');
            Route::post('store', [AdminController::class, 'coupen_store'])->name('coupen.store');
            Route::get('edit', [AdminController::class, 'coupen_edit'])->name('coupen.edit');
            Route::post('update', [AdminController::class, 'coupen_update'])->name('coupen.update');
            Route::get('used_coupen', [AdminController::class, 'coupen_use'])->name('coupen.use');
        });

        Route::get('user_login', [AdminController::class, 'user_login'])->name('user.login');
        Route::post('user_store', [AdminController::class, 'user_store'])->name('user.store');
        Route::get('user_register', [AdminController::class, 'user_register'])->name('user.register');
        Route::post('user_register_validate', [AdminController::class, 'user_register_validate'])->name('user.register.validate');
    });
});

Route::prefix('guest_user')->group(function () {
    Route::get('index', [UserController::class, 'guest_create'])->name('guest.create');
    Route::get('products', [UserController::class, 'guest_products'])->name('guest.products');
    Route::get('categories', [UserController::class, 'guest_categories'])->name('guest.category');
    Route::get('contact', [UserController::class, 'guest_contact'])->name('guest.contact');
    Route::get('login', [UserController::class, 'guest_login'])->name('guest.login');
    Route::get('register', [UserController::class, 'guest_register'])->name('guest.register');
    Route::post('confirm_register', [UserController::class, 'guest_register_validate'])->name('guest.confirm.register');
    Route::post('send_contact', [UserController::class, 'guest_contact_validate'])->name('guest.confirm.contact');
    Route::post('login_validate', [UserController::class, 'login_validate'])->name('guest.login.validate');
});
