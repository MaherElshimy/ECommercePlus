<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\Cart\CartController;
use App\Http\Controllers\Home\Comments\CommentController;
use App\Http\Controllers\Home\Order\OrderController;
use App\Http\Controllers\Home\Payments\PaymentController;
use App\Http\Controllers\Home\Product\ProductController;


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

Route::get('/', [ProductController::class, 'viewAllProducts']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});





Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');


Route::post('/add_cart/{id}', [CartController::class, 'addCart']);
Route::get('/show_cart', [CartController::class, 'showCart']);
Route::get('/remove_cart/{id}', [CartController::class, 'removeCart']);
Route::get('/cash_order', [CartController::class, 'processCashOrder']);


Route::get('/stripe/{totalPrice}', [PaymentController::class, 'showStripePaymentPage']);
Route::post('stripe/{totalPrice}', [PaymentController::class, 'processStripePayment'])->name('stripe.post');

Route::get('/show_order', [OrderController::class, 'showOrderHistory']);
Route::get('/cancel_order/{id}', [OrderController::class, 'cancelOrder']);

Route::post('/add_comment', [CommentController::class, 'addComment']);
Route::post('/add_reply', [CommentController::class, 'addReply']);

Route::get('/product_search', [ProductController::class, 'productSearch']);
Route::get('/products', [ProductController::class, 'products']);
Route::get('/search_product', [ProductController::class, 'searchProduct']);
Route::get('/product_details/{id}', [ProductController::class, 'productDetails']);
