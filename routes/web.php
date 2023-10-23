<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerRegistrationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pre-registro', [CustomerRegistrationController::class, 'index'])->name('customer-registration.index');
Route::post('/pre-registro', [CustomerRegistrationController::class, 'store'])->name('customer-registration.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/pre-registro', [CustomerRegistrationController::class, 'store'])->name('customer-registration');
