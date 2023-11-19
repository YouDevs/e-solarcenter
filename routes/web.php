<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerRegistrationController;
use App\Http\Controllers\CustomerSupport\CustomerController;
use App\Http\Controllers\Marketing\ProductController;

/*
* TODO: Eliminar la opción de register que solo quede el pre-registro.
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
        // return view('auth.login');
    });
});


Route::get('/pre-registro', [CustomerRegistrationController::class, 'index'])->name('customer-registration.index');
Route::post('/pre-registro', [CustomerRegistrationController::class, 'store'])->name('customer-registration.store');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['role:administration'])->group(function () {
        // Rutas específicas para admin
    });

    Route::middleware(['role:customer_support'])->group(function () {
        Route::resource('customers', CustomerController::class)->except(['create', 'store']);
    });

    Route::middleware(['role:marketing'])->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
