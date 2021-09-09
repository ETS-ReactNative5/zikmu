<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Home;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Payment;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('basket/store', [BasketController::class, "store"])->name('basket.store');

    Route::get('/payment/add_card', [Payment::class, "add_card"])->name('payment.add_card');
    Route::post('/payment/add_card', [Payment::class, "store_card"])->name('payment.store_card');
    Route::get('/payment/success', [Payment::class, "success"])->name('payment.success');
    Route::get('/payment/error', [Payment::class, "error"])->name('payment.error');

});

Route::get('/basket', [BasketController::class, "index"])->name('basket.index');
Route::post('/basket/add', [BasketController::class, "add_product"])->name('basket.add');
Route::post('/basket/remove', [BasketController::class, "remove_product"])->name('basket.remove');
Route::post('/basket/update', [BasketController::class, "update_product"])->name('basket.update');
Route::get('/basket/empty', [BasketController::class, "empty_cart"])->name('basket.empty');

Route::get('/product/{product}-{slug}', [ProductController::class, "show"])->name('product.show');
Route::post('/product/{product}-{slug}', [ProductController::class, "show"])->name('product.show.post');

Route::get('/category/{category}-{slug}', [CategoryController::class, 'show'])->name('category.show');

Route::post('/search', [SearchController::class, "get"])->name('search.post');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.get');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.post');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.post');
Route::get('/newsletter/unsubscribe', [NewsletterController::class, "unsubscribe"])->name('newsletter.unsub');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, "exec_unsub"])->name('newsletter.unsub.post');

Route::get('/mentions-legales',[Home::class, 'mts'])->name('mts');
Route::get('/sitemap', [Home::class, 'sitemap'])->name('sitemap');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

require __DIR__.'/auth.php';
