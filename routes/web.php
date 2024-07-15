<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware("auth")->group(function () {
    Route::get('plans', [SubscriptionController::class, 'index']);
    Route::get('plans/{plan}', [SubscriptionController::class, 'show'])->name("plans.show");
    Route::post('subscription', [SubscriptionController::class, 'subscription'])->name("subscription.create");


    Route::get('checkout', [SubscriptionController::class, 'checkout'])->name("checkout");
    Route::post('checkout', [SubscriptionController::class, 'checkout_form'])->name("checkout_form");
});
