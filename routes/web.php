<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminFarmerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('registers');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/markets', function () {
    return view('markets');
});

Route::get('/vendor/dashboard', [ProductController::class, 'dashboard'])
    ->name('vendor.dashboard');

Route::resource('products', ProductController::class);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/admin/products', [AdminController::class, 'products'])
    ->name('admin.products');

Route::patch('/admin/products/{id}/approve', [AdminController::class, 'approveProduct'])
    ->name('admin.products.approve');

Route::patch('/admin/products/{id}/reject', [AdminController::class, 'rejectProduct'])
    ->name('admin.products.reject');

Route::get('/admin/categories', [AdminCategoryController::class, 'index'])
    ->name('admin.categories');

Route::post('/admin/categories', [AdminCategoryController::class, 'store'])
    ->name('admin.categories.store');

Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])
    ->name('admin.categories.destroy');

Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->name('admin.users');

Route::get('/admin/farmers', [AdminFarmerController::class, 'index'])
    ->name('admin.farmers');

Route::get('/admin/orders', [AdminOrderController::class, 'index'])
    ->name('admin.orders');

Route::get('/admin/reports', [AdminReportController::class, 'index'])
    ->name('admin.reports');

Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])
    ->name('customer.dashboard');

Route::get('/customer/product/{id}', [CustomerController::class, 'product'])
    ->name('customer.product');

Route::post('/customer/cart/add/{id}', [CustomerController::class, 'addToCart'])
    ->name('customer.cart.add');

Route::get('/customer/cart', [CustomerController::class, 'cart'])
    ->name('customer.cart');

Route::get('/customer/checkout', [CustomerController::class, 'checkout'])
    ->name('customer.checkout');

Route::post('/customer/order/place', [CustomerController::class, 'placeOrder'])
    ->name('customer.order.place');

Route::get('/customer/orders', [CustomerOrderController::class, 'index'])
    ->name('customer.orders');

Route::delete('/customer/cart/{id}', [CartController::class, 'destroy'])
    ->name('customer.cart.remove');
