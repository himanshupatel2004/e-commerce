<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StripePaymentController;






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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('shop',[HomeController::class,'shop'])->name('shop');

Route::get('product-details', function () {
    return view('product-details');
})->name('product.details');

Route::get('contact', function () {
    return view('contact');
})->name('contact');


Route::get('testimonial', function () {
    return view('testimonial');
})->name('testimonial');



// Admin Pages

Route::get('admin/login', function () {
    return view('admin-panel.login');
})->name('login');


Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('admin/register', [RegisterController::class, 'create'])->name('admin.register');
Route::post('admin/store', [RegisterController::class, 'register'])->name('admin.store');



Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin-panel.dashboard');
    })->name('dashboard');
    Route::get('users/list', [UserController::class, 'index'])->name('users.list');


    Route::get('add/cart', [ProductController::class, 'addCart'])->name('add.cart');
    Route::get('total/payout', [ProductController::class, 'totalPayout'])->name('total.payout');
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

    Route::get('update/cart', [ProductController::class, 'updateCart'])->name('update.cart');
    Route::get('remove/cart', [ProductController::class, 'removeCart'])->name('remove.cart');

    Route::prefix('products')->group(function(){
        Route::get('list', [ProductController::class, 'index'])->name('products.list');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');

        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('products.show');
    });

});





