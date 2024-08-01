<?php

use App\Http\Controllers\PostController;
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

    Route::get('change/monthly', [SubscriptionController::class, 'Monthly'])->name('change');

    Route::get('cancel', [SubscriptionController::class, 'cancel'])->name('cancel');

    Route::get('trial/{plan}', [SubscriptionController::class, 'trial'])->name('plans.trial');

    Route::post('subscription/trial', [SubscriptionController::class, 'subscriptiontrial'])->name("subscription.trial");


    Route::get('checkout', [SubscriptionController::class, 'checkout'])->name("checkout");
    Route::post('checkout', [SubscriptionController::class, 'checkout_form'])->name("checkout_form");



    Route::get('/posts',[PostController::class,'index']);
    Route::get('/post/{post}',[PostController::class,'show']);
    Route::post('/posts/{id}/join-channel', [PostController::class, 'joinChannel']);
    Route::post('/posts/{id}/leave-channel', [PostController::class, 'leaveChannel']);
    Route::get('/posts/{id}/current-readers-count', [PostController::class, 'getCurrentReadersCount']);


});
