<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware('maintenance')->group(function () {
    Route::group(['as' => 'user.'], function () {
        Route::get('auth/{provider}/login', 'Auth\LoginController@redirect')->name('login.social');
        Route::get('{provider}/callback', 'Auth\LoginController@callback')->name('login.social.callback');

        Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
        Route::get('forget', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('forget');
        Route::middleware('auth')->group(function (){
            Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
            Route::post('profile', [App\Http\Controllers\UserController::class, 'update']);

            Route::get('/change/password', [App\Http\Controllers\UserController::class, 'password'])->name('password');
            Route::post('/change/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('password.update');
        });
    });

    Route::group(['as' => 'order.', 'prefix' => 'order'], function () {
        Route::post('/checkout/{id}/callback', [App\Http\Controllers\OrderController::class, 'pmCallback'])->name('pm.callback');

        Route::middleware('auth')->group(function () {
            Route::post('/store', [App\Http\Controllers\OrderController::class, 'store'])->name('store');

            Route::get('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->name('cart');

//        Route::get('orders', [App\Http\Controllers\OrderController::class,'index'])->name('index');

            Route::get('/{id}/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
            Route::post('/{id}/checkout', [App\Http\Controllers\OrderController::class, 'payment']);

            Route::get('/orders/destroy', [App\Http\Controllers\OrderController::class, 'destroy']);
            Route::get('/orders/{rowid}/remove', [App\Http\Controllers\OrderController::class, 'remove']);
        });
    });
    Route::group(['as' => 'ajax.'], function () {
        Route::get('/order/{id}/{qty}/{options}/create', [App\Http\Controllers\AjaxController::class, 'create'])->name('order.create');
        Route::get('/order/{rowId}/{num}/update', [App\Http\Controllers\AjaxController::class, 'update'])->name('order.update');
        Route::get('/order/{rowId}/remove', [App\Http\Controllers\AjaxController::class, 'remove'])->name('order.remove');
        Route::get('/order/destroy', [App\Http\Controllers\AjaxController::class, 'destroy'])->name('order.destroy');

        Route::get('/change/{lang}/languages', [App\Http\Controllers\AjaxController::class, 'change'])->name('languages.change');
    });

    Route::get('/lien-he', [App\Http\Controllers\ContactController::class, 'index']);
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('send.contact');

    Route::get('/tag/{alias}', [App\Http\Controllers\SearchController::class, 'tag'])->name('tag.show');
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

    Route::resource('comments', CommentController::class);


//    Route::get('/posts/{id}/author', [App\Http\Controllers\HomeController::class, 'author'])->name('post.author');

    Route::get('/sitemap.xml', [App\Http\Controllers\SitemapXmlController::class, 'generate']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('{slug}', [App\Http\Controllers\HomeController::class, 'translation'])->name('slug');

    Auth::routes();
});

Route::post('/maintenance', [App\Http\Controllers\HomeController::class, 'maintenance'])->name('maintenance');
Route::fallback(function () {
    return abort(404);
});

