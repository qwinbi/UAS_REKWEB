<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/products', [HomeController::class, 'products'])->name('products.index');
Route::get('/products/{id}', [HomeController::class, 'showProduct'])->name('products.show');

// Guest Routes (Hanya untuk user dengan role guest)
Route::middleware(['auth', 'guest.user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // TAMBAH INI
    
    // Checkout & Payment
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/payment-upload', [PaymentController::class, 'process'])->name('payment.process');
});

// Admin Routes (Hanya untuk user dengan role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Products Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Payments Management
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::post('/payments/{id}/status', [AdminController::class, 'updatePaymentStatus'])->name('admin.payments.status');
    
    // Settings
    Route::get('/about', [AdminController::class, 'about'])->name('admin.about');
    Route::post('/about', [AdminController::class, 'updateAbout'])->name('admin.about.update');
    Route::get('/about/remove-photo', [AdminController::class, 'removeAboutPhoto'])->name('admin.about.removePhoto');
    
    Route::get('/footer', [AdminController::class, 'footer'])->name('admin.footer');
    Route::post('/footer', [AdminController::class, 'updateFooter'])->name('admin.footer.update');
    Route::get('/logo', [AdminController::class, 'logo'])->name('admin.logo');
    Route::post('/logo', [AdminController::class, 'updateLogo'])->name('admin.logo.update');
});