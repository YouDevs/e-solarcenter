<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerRegistrationController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\CustomerSupport\CustomerController;
use App\Http\Controllers\CustomerSupport\OrderController;
use App\Http\Controllers\Marketing\ProductController;


Route::middleware(['auth'])->group(function () {
    // Delete this routes when deploy is fucking ready!
    // Route::get('/symlink', function () {
    //     Artisan::call('storage:link');
    //     return 'Migrate fresh successfully!';
    // });

    Route::get('/migrate-fresh', function () {
        try {
            Artisan::call('migrate:fresh');

            Artisan::call('db:seed');

            return 'Migrate fresh successfully!';
        } catch (\Exception $e) {
            return 'Error clearing cache: ' . $e->getMessage();
        }
    });

    Route::get('/clear-cache', function () {
        try {
            Artisan::call('optimize:clear');
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:clear');
            Artisan::call('view:cache');
            return 'Cache cleared successfully!';
        } catch (\Exception $e) {
            return 'Error clearing cache: ' . $e->getMessage();
        }
    });

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/buscar-productos', [HomeController::class, 'searchProducts'])->name('search-products');

    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

    Route::get('checkout-details', [CheckoutController::class, 'details'])->name('checkout.details');
    Route::get('checkout-shipping', [CheckoutController::class, 'shipping'])->name('checkout.shipping');
    Route::post('checkout-selected-address', [CheckoutController::class, 'selectedAddress'])->name('checkout.selected-address');
    Route::get('checkout-payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::get('checkout-complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('checkout/{order}/update', [CheckoutController::class, 'update'])->name('checkout.update');

    Route::get('cuenta/perfil', [CustomerAccountController::class, 'profile'])->name('account.profile');
    Route::put('cuenta/perfil/{customer}/update', [CustomerAccountController::class, 'profileUpdate'])->name('account.profile-update');

    Route::get('cuenta/ordenes', [CustomerAccountController::class, 'orders'])->name('account.orders');
    Route::delete('cuenta/ordenes/{order}/delete', [CustomerAccountController::class, 'orderDelete'])->name('account.orders.delete');

    Route::get('cuenta/contacto', [CustomerAccountController::class, 'contact'])->name('account.contact');
    Route::post('cuenta/contacto', [CustomerAccountController::class, 'sendCustomerContact'])->name('account.send-contact');
});


Route::get('/pre-registro', [CustomerRegistrationController::class, 'index'])->name('customer-registration.index');
Route::post('/pre-registro', [CustomerRegistrationController::class, 'store'])->name('customer-registration.store');
Route::get('/pre-registro/exitoso', function() {
    return view('auth.pre-register');
})->name('customer-registration.success');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['role:administration|operator'])->group(function () {
        // Rutas específicas para admin
    });

    Route::middleware(['role:customer_support|operator'])->group(function () {
        Route::resource('customers', CustomerController::class)->except(['create', 'store']);
        Route::resource('orders', OrderController::class)->except(['create', 'store']);

        Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
        Route::post('orders/{order}/update-tracking-number', [OrderController::class, 'updateTrankingNumber'])->name('orders.update.tracking-number');
        Route::post('orders/{order}/invoice', [OrderController::class, 'updateInvoice'])->name('orders.update.invoice');
    });

    Route::middleware(['role:marketing|operator'])->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);

        Route::get('products/get-from-netsuite', [ProductController::class, 'getProductsFromNetsuite'])->name('products.get-from-netsuite');
    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
