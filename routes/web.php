<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeforeLoginController;

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
            Route::get('edit/{product_id}', [AdminController::class, 'products_edit'])->name('products.edit');
            Route::post('update', [AdminController::class, 'products_update'])->name('products.update');
            Route::get('add_product', [AdminController::class, 'products_add'])->name('products.add');
            Route::post('product_store', [AdminController::class, 'product_store'])->name('products.store');
            Route::get('purchased_products', [AdminController::class, 'products_purchase'])->name('products.purchase');
            Route::get('delete/{product_id}', [AdminController::class, 'products_delete'])->name('products.delete');
            Route::get('activate/{product_id}', [AdminController::class, 'products_activate'])->name('products.activate');
            Route::get('deactivate/{product_id}', [AdminController::class, 'products_deactivate'])->name('products.deactivate');
            Route::get('delete/{product_id}', [AdminController::class, 'products_delete'])->name('products.delete');
            Route::get('get-required-data', [AdminController::class, 'getRequiredData'])->name('products.get');
            Route::get('reactivate/{product_id}', [AdminController::class, 'product_reactivate'])->name('products.reactivate');
        });

        Route::prefix('category')->group(function () {
            Route::get('available_category', [AdminController::class, 'category_create'])->name('category.available');
            Route::get('category_add', [AdminController::class, 'category_add'])->name('category.add');
            Route::post('category_store', [AdminController::class, 'category_store'])->name('category.store');
            Route::get('category_edit/{id}', [AdminController::class, 'category_edit'])->name('category.edit');
            Route::post('category_update', [AdminController::class, 'category_update'])->name('category.update');
            Route::get('shoes', [AdminController::class, 'shoes'])->name('category.shoes');
            Route::get('shirt', [AdminController::class, 'shirt'])->name('category.shirt');
            Route::get('jeans', [AdminController::class, 'jeans'])->name('category.jeans');
            Route::get('hoodie', [AdminController::class, 'hoodie'])->name('category.hoodie');
            Route::get('activate/{id}', [AdminController::class, 'activate_category'])->name('category.activate');
            Route::get('deactivate/{id}', [AdminController::class, 'deactivate_category'])->name('category.deactivate');
            Route::get('delete/{id}', [AdminController::class, 'delete_category'])->name('category.delete');
            Route::get('reactivate/{category_name}', [AdminController::class, 'reactivate_category'])->name('category.reactivate');
            Route::get('get-data', [AdminController::class, 'getData'])->name('category.get.data');



        });

        Route::prefix('customers')->group(function () {
            Route::get('customer_details', [AdminController::class, 'customer_create'])->name('customers.details');
            Route::get('add', [AdminController::class, 'customer_add'])->name('customers.add');
            Route::post('customer_store', [AdminController::class, 'customer_store'])->name('customers.store');
            Route::get('customer_edit/{id}', [AdminController::class, 'customer_edit'])->name('customer.edit');
            Route::post('customer_update', [AdminController::class, 'customer_update'])->name('customer.update');
            Route::get('get-all-customers', [AdminController::class, 'getAllCustomer'])->name('customers.getAll');
            Route::get('deactivate/{id}', [AdminController::class, 'deactivateCustomer'])->name('customers.deactivate');
            Route::get('activate/{id}', [AdminController::class, 'activateCustomer'])->name('customers.activate');
            Route::get('delete/{id}', [AdminController::class, 'deleteCustomer'])->name('customer.delete');
            Route::get('reactivate/{id}', [AdminController::class, 'reactivateCustomer'])->name('customer.reactivate');
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
            Route::get('load_coupen', [AdminController::class, 'coupen_load'])->name('coupen.load');
            Route::get('deactivate/{id}', [AdminController::class, 'deactivate_coupen'])->name('coupen.activate');
            Route::get('edit-coupens/{id}', [AdminController::class, 'getSelectedCoupen'])->name('coupens.edit');
            Route::get('activate/{id}', [AdminController::class, 'activate_coupen']);
            Route::get('delete-coupen/{id}', [AdminController::class, 'deleteCoupen'])->name('coupen.delete');
        });

        Route::prefix('sizes')->group(function () {
            Route::get('available', [AdminController::class, 'sizes_available'])->name('sizes.available');
            Route::get('add', [AdminController::class, 'sizes_add'])->name('sizes.add');
            Route::post('store', [AdminController::class, 'sizes_store'])->name('sizes.store');
            Route::get('deactivate/{id}', [AdminController::class, 'deactviate_sizes'])->name('sizes.deactivate');
            Route::get('activate/{id}', [AdminController::class, 'activate_sizes'])->name('sizes.activate');
            Route::get('delete/{id}', [AdminController::class, 'delete_sizes'])->name('sizes.delete');
            Route::get('reactive/{size_name}', [AdminController::class, 'reactivate_sizes'])->name('sizes.reactivate');
            Route::get('get-data', [AdminController::class, 'getSizes']);
            Route::get('edit/{id}', [AdminController::class, 'edit_size']);
            Route::post('update', [AdminController::class, 'size_update']);
        });
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
    Route::get('activate/{email}/{token}', [UserController::class, 'activate_account'])->name('guest.account.activate');
    Route::view('forget_password_form', 'guest.forget_password_form')->name('forget.password');
    Route::post('forget_password_form_submit', [BeforeLoginController::class, 'forget_password_form_submit'])->name('forget.password.form.submit');
    Route::get('verify_forget_pwd_otp/{email}/{token}', [BeforeLoginController::class, 'verify_forget_pwd_otp'])->name('verify.forget.password.otp');
    Route::post('verify_otp_forget_password_action', [BeforeLoginController::class, 'verify_otp_forget_password_action'])->name('verify.otp.forget.password.action');
    Route::view('verify_otp_forget_password', 'verify_otp_forget_pwd')->name('verify.otp.forget.password');
    Route::view('reset_pwd', 'guest.reset_pwd')->name('reset.pwd');
    Route::post('reset_pwd_action', [BeforeLoginController::class, 'reset_pwd_action'])->name('reset.password.action');
    Route::get('edit_profile', [UserController::class, 'edit_profile'])->name('user.edit.profile');
    Route::get('logout', [UserController::class, 'guest_logout'])->name('guest.logout');
    Route::post('edit_profile_validate', [UserController::class, 'edit_profile_validate'])->name('edit.profile.validate');
    Route::view('change_password', 'guest.change_password')->name('user.change.password');
    Route::post('change_password_validate', [UserController::class, 'change_password_validate'])->name('change.password.validate');
});