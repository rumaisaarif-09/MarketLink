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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/login', [AuthController::class, 'showLoginChoice'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/login/customer', [AuthController::class, 'showCustomerLogin'])->name('login.customer');
Route::post('/login/customer', [AuthController::class, 'loginCustomer'])->name('login.customer.store');

Route::get('/login/vendor', [AuthController::class, 'showVendorLogin'])->name('login.vendor');
Route::post('/login/vendor', [AuthController::class, 'loginVendor'])->name('login.vendor.store');

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.store');

Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/home', HomeController::class)->name('landing');

Route::get('/markets', [MarketController::class, 'index'])->name('markets.index');

Route::get('/products', [CustomerController::class, 'index'])->name('products.index');
Route::get('/customer/product/{id}', [CustomerController::class, 'product'])->name('customer.product');
Route::post('/favorites/{type}/{id}', [CustomerController::class, 'toggleFavorite'])->name('favorites.toggle');

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::post('/customer/cart/add/{id}', [CartController::class, 'addToCart'])->name('customer.cart.add');
    Route::get('/customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    Route::delete('/customer/cart/{id}', [CartController::class, 'destroy'])->name('customer.cart.remove');
    Route::get('/customer/checkout', [CheckoutController::class, 'index'])->name('customer.checkout');
    Route::post('/customer/order/place', [CheckoutController::class, 'placeOrder'])->name('customer.order.place');
    Route::post('/customer/order/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('customer.order.cancel');
    Route::get('/customer/orders', [CustomerOrderController::class, 'index'])->name('customer.orders');
    Route::post('/customer/products/{product}/reviews', [ReviewController::class, 'store'])->name('customer.reviews.store');
});

Route::middleware(['auth', 'role:vendor'])->group(function () {
Route::get('/vendor/dashboard', [ProductController::class, 'dashboard'])->name('vendor.dashboard');
Route::get('/vendor/products', [ProductController::class, 'index'])->name('vendor.products.index');
Route::get('/vendor/products/create', [ProductController::class, 'create'])->name('vendor.products.create');
Route::post('/vendor/products', [ProductController::class, 'store'])->name('vendor.products.store');
Route::get('/vendor/products/{id}', [ProductController::class, 'show'])->name('vendor.products.show');
Route::get('/vendor/products/{id}/edit', [ProductController::class, 'edit'])->name('vendor.products.edit');
Route::put('/vendor/products/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
Route::delete('/vendor/products/{id}', [ProductController::class, 'destroy'])->name('vendor.products.destroy');
Route::get('/vendor/orders', [VendorOrderController::class, 'index'])->name('vendor.orders.index');
Route::post('/vendor/orders/{order}/status', [VendorOrderController::class, 'updateStatus'])->name('vendor.orders.updateStatus');
Route::get('/vendor/profile', [ProfileController::class, 'edit'])->name('vendor.profile.edit');
Route::put('/vendor/profile', [ProfileController::class, 'update'])->name('vendor.profile.update');
Route::get('/vendor/reviews', [ReviewController::class, 'vendorIndex'])->name('vendor.reviews.index');
Route::post('/vendor/reviews/{review}/response', [ReviewController::class, 'respond'])->name('vendor.reviews.respond');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
Route::patch('/admin/products/{id}/approve', [AdminController::class, 'approveProduct'])->name('admin.products.approve');
Route::patch('/admin/products/{id}/reject', [AdminController::class, 'rejectProduct'])->name('admin.products.reject');
Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.role');
Route::patch('/admin/users/{user}/access', [AdminUserController::class, 'toggleAccess'])->name('admin.users.access');
Route::get('/admin/farmers', [AdminFarmerController::class, 'index'])->name('admin.farmers');
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/list', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::post('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
Route::patch('/admin/reviews/{review}/visibility', [ReviewController::class, 'toggleVisibility'])->name('admin.reviews.visibility');
});
