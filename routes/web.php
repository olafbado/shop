<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClientMiddleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Home
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [\App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/toggle', [\App\Http\Controllers\Admin\UserController::class, 'toggleActive'])->name('users.toggle');

    // Products Management
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('/products/filter', [\App\Http\Controllers\Admin\ProductController::class, 'filter'])->name('products.filter');
    Route::patch('/products/{product}/toggle', [\App\Http\Controllers\Admin\ProductController::class, 'toggleActive'])->name('products.toggle');

    // Categories Management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->only(['index', 'create', 'store']);
    Route::post('/categories/{category}/assign', [\App\Http\Controllers\Admin\CategoryController::class, 'assignProduct'])->name('categories.assign');
    Route::post('/categories/{category}/unassign', [\App\Http\Controllers\Admin\CategoryController::class, 'unassignProduct'])->name('categories.unassign');

    // Orders Management (read-only)
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');

    // Reviews Moderation
    Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::patch('/reviews/{review}/hide', [\App\Http\Controllers\Admin\ReviewController::class, 'hide'])->name('reviews.hide');
    Route::patch('/reviews/{review}/toggle', [\App\Http\Controllers\Admin\ReviewController::class, 'toggle'])->name('reviews.toggle');
});

Route::middleware(['auth', ClientMiddleware::class])->prefix('client')->name('client.')->group(function () {
    Route::get('/panel', [\App\Http\Controllers\Client\ClientPanelController::class, 'index'])->name('panel');
    Route::get('/products', [\App\Http\Controllers\Client\ClientProductController::class, 'index'])->name('products.index');

    // Koszyk
    Route::get('/cart', [\App\Http\Controllers\Client\ClientCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [\App\Http\Controllers\Client\ClientCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{productId}', [\App\Http\Controllers\Client\ClientCartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [\App\Http\Controllers\Client\ClientCartController::class, 'clear'])->name('cart.clear');

    // Zamówienia
    Route::get('/orders', [\App\Http\Controllers\Client\ClientOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [\App\Http\Controllers\Client\ClientOrderController::class, 'store'])->name('orders.store');

    // Profil klienta
    Route::get('/profile/edit', [\App\Http\Controllers\Client\ClientProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [\App\Http\Controllers\Client\ClientProfileController::class, 'update'])->name('profile.update');

    // Adresy klienta
    Route::get('/addresses', [\App\Http\Controllers\Client\ClientAddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [\App\Http\Controllers\Client\ClientAddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [\App\Http\Controllers\Client\ClientAddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [\App\Http\Controllers\Client\ClientAddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{address}', [\App\Http\Controllers\Client\ClientAddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [\App\Http\Controllers\Client\ClientAddressController::class, 'destroy'])->name('addresses.destroy');

    // Opinie o produktach
    Route::get('/products/{product}/review', [\App\Http\Controllers\Client\ClientReviewController::class, 'create'])->name('reviews.create');
    Route::post('/products/{product}/review', [\App\Http\Controllers\Client\ClientReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
