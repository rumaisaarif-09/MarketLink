<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFarmerController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/markets', function () {
    return view('markets');
});

Route::get('/products', [CustomerController::class, 'index'])->name('products.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

Route::get('/vendor/dashboard', [ProductController::class, 'dashboard'])->name('vendor.dashboard');
Route::get('/vendor/products', [ProductController::class, 'index'])->name('vendor.products.index');
Route::get('/vendor/products/create', [ProductController::class, 'create'])->name('vendor.products.create');
Route::post('/vendor/products', [ProductController::class, 'store'])->name('vendor.products.store');
Route::get('/vendor/products/{id}', [ProductController::class, 'show'])->name('vendor.products.show');
Route::get('/vendor/products/{id}/edit', [ProductController::class, 'edit'])->name('vendor.products.edit');
Route::put('/vendor/products/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
Route::delete('/vendor/products/{id}', [ProductController::class, 'destroy'])->name('vendor.products.destroy');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
Route::patch('/admin/products/{id}/approve', [AdminController::class, 'approveProduct'])->name('admin.products.approve');
Route::patch('/admin/products/{id}/reject', [AdminController::class, 'rejectProduct'])->name('admin.products.reject');
Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
Route::get('/admin/farmers', [AdminFarmerController::class, 'index'])->name('admin.farmers');
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/list', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::post('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');

Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
Route::get('/customer/product/{id}', [CustomerController::class, 'product'])->name('customer.product');
Route::post('/customer/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::get('/customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::get('/customer/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
Route::post('/customer/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');
Route::get('/customer/orders', [CustomerOrderController::class, 'index'])->name('customer.orders');
Route::delete('/customer/cart/{id}', [CartController::class, 'destroy'])->name('customer.cart.remove');
