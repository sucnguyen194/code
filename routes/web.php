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
Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'],function(){
    Route::get('/',  [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::get('login',  [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login',  [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::middleware('auth:admin')->group(function (){
        Route::post('logout',  [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('logs', [App\Http\Controllers\Admin\DashboardController::class, 'logs'])->name('logs');

        Route::get('data/roles',[App\Http\Controllers\Admin\RoleController::class,'data'])->name('roles.data');
        Route::resource('roles',RoleController::class);

        Route::get('data/permissions',[App\Http\Controllers\Admin\PermissionsController::class,'data'])->name('permissions.data');
        Route::resource('permissions',PermissionsController::class);

        Route::get('data/admins',[App\Http\Controllers\Admin\AdminController::class,'data'])->name('admins.data');
        Route::resource('admins',AdminController::class);

        Route::get('add/tags',[App\Http\Controllers\Admin\TagController::class,'ajax_create'])->name('tags.add');
        Route::post('add/tags',[App\Http\Controllers\Admin\TagController::class,'add'])->name('tags.add');
        Route::get('data/tags',[App\Http\Controllers\Admin\TagController::class,'data'])->name('tags.data');
        Route::resource('tags',TagController::class);

        //categories
        Route::post('/add/categories', [App\Http\Controllers\Admin\CategoryController::class,'add'])->name('categories.add');
        Route::get('/data/categories',[App\Http\Controllers\Admin\CategoryController::class,'data'])->name('categories.data');
        Route::resource('categories',CategoryController::class);

        //videos
        Route::resource('/posts/videos',VideoController::class,['as' => 'posts']);
        //galeries
        Route::resource('/posts/galleries',GalleryController::class,['as' => 'posts']);
        //pages
        Route::resource('/posts/pages',PageController::class,['as' => 'posts']);
        //posts categories

        Route::resource('/posts/categories',PostCategoryController::class,['as' => 'posts']);

        Route::get('/data/posts/',[App\Http\Controllers\Admin\PostController::class,'data'])->name('posts.data');
        Route::resource('posts',PostController::class);

        //products categories
        Route::resource('/products/categories',ProductCategoryController::class,['as' => 'products']);

        //products

        Route::get('data/products',[App\Http\Controllers\Admin\ProductController::class,'data'])->name('products.data');
        Route::resource('products',ProductController::class);

        Route::get('data/discounts',[App\Http\Controllers\Admin\DiscountController::class,'data'])->name('discounts.data');
        Route::get('discounts/{discount}/history', [App\Http\Controllers\Admin\DiscountController::class,'history'])->name('discounts.history');
        Route::resource('discounts',DiscountController::class);

        Route::get('attributes/{id}/render',[App\Http\Controllers\Admin\AttributeController::class,'render'])->name('attributes.render');
        Route::get('data/attributes',[App\Http\Controllers\Admin\AttributeController::class,'data'])->name('attributes.data');
        Route::resource('attributes',AttributeController::class);

        //Photos
        Route::get('data/photos',[App\Http\Controllers\Admin\PhotoController::class,'data'])->name('photos.data');
        Route::resource('photos',PhotoController::class);

        //Menus
        Route::get('/sort/menus', [App\Http\Controllers\Admin\MenuController::class,'setMenuSort'])->name('ajax.menu.sort');
        Route::post('/append/menus', [App\Http\Controllers\Admin\MenuController::class,'append'])->name('ajax.append.menu');
        Route::get('/menus/{position}/position', [App\Http\Controllers\Admin\MenuController::class,'position'])->name('change.position.menu');
        Route::resource('menus',MenuController::class);

        //supports
        Route::resource('/supports/customers',CustomerController::class,['as' => 'supports']);
        Route::get('data/supports',[App\Http\Controllers\Admin\SupportController::class,'data'])->name('supports.data');
        Route::resource('supports',SupportController::class);

        Route::get('data/orders',[App\Http\Controllers\Admin\OrderController::class,'data'])->name('orders.data');
        Route::get('print/{id}/orders',[App\Http\Controllers\Admin\OrderController::class,'print'])->name('orders.print');
        Route::resource('orders',OrderController::class);

        //settings
        Route::get('settings',[App\Http\Controllers\Admin\SettingController::class,'index'])->name('settings');
        Route::post('settings',[App\Http\Controllers\Admin\SettingController::class,'update']);

        //contacts
        Route::get('contacts/data', [App\Http\Controllers\Admin\ContactController::class,'data'])->name('contacts.data');
        Route::resource('contacts',ContactController::class);

        Route::get('data/users',[App\Http\Controllers\Admin\UserController::class,'data'])->name('users.data');
        Route::resource('users',UserController::class);

        //source
        Route::get('ajax/load/sources', [App\Http\Controllers\Admin\SourceController::class,'load'])->name('ajax.load.sources');
        Route::post('ajax/push/sources', [App\Http\Controllers\Admin\SourceController::class,'push'])->name('ajax.push.sources');
        Route::resource('sources',SourceController::class);

        //languages
        Route::get('change/{lang}/languages', [App\Http\Controllers\Admin\LanguageController::class,'change'])->name('languages.change');
        Route::post('active/{id}/languages',[App\Http\Controllers\Admin\LanguageController::class,'active'])->name('languages.active');
        Route::get('data/languages',[App\Http\Controllers\Admin\LanguageController::class,'data'])->name('languages.data');

        Route::resource('languages', LanguageController::class);

        Route::get('data/comments',[App\Http\Controllers\Admin\CommentController::class,'data'])->name('comments.data');
        Route::get('comments/{type}/list',[App\Http\Controllers\Admin\CommentController::class,'list'])->name('comments.list');
        Route::get('comments/{type}/{id}/reply',[App\Http\Controllers\Admin\CommentController::class,'reply'])->name('comments.reply');
        Route::resource('comments', CommentController::class);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        Route::get('ajax/data/sort', [App\Http\Controllers\Admin\AjaxController::class,'getEditDataSort'])->name('ajax.data.sort');
        Route::get('ajax/data/public', [App\Http\Controllers\Admin\AjaxController::class,'getEditDataPublic'])->name('ajax.data.public');
        Route::get('ajax/data/status',[App\Http\Controllers\Admin\AjaxController::class,'getEditDataStatus'])->name('ajax.data.status');
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    });
});


Route::get('auth/{provider}/login','Auth\LoginController@redirect')->name('login.social');
Route::get('{provider}/callback','Auth\LoginController@callback')->name('login.social.callback');

Route::group(['namespace' => 'User'], function(){
    Route::get('login',  [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login',  [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('forget',  [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('forget');
    Route::middleware('auth:web')->group(function(){
        Route::get('profile',[App\Http\Controllers\UserController::class,'profile'])->name('profile');
        Route::post('profile',[App\Http\Controllers\UserController::class,'update']);
    });
});

Route::group(['as' => 'orders.'], function () {
    Route::get('orders', [App\Http\Controllers\OrderController::class,'index'])->name('index');
    Route::get('checkout', [App\Http\Controllers\OrderController::class,'checkout'])->name('checkout');
    Route::post('checkout',[App\Http\Controllers\OrderController::class,'store']);
    Route::get('orders/destroy', [App\Http\Controllers\OrderController::class,'destroy']);
    Route::get('orders/{rowid}/remove',[App\Http\Controllers\OrderController::class,'remove'] );

    Route::post('store',[App\Http\Controllers\OrderController::class,'store'])->middleware('auth')->name('store');
});
Route::group(['prefix' => 'ajax','as' => 'ajax.'], function () {
    Route::get('order/{id}/{qty}/{options}/create', [App\Http\Controllers\AjaxController::class,'create'])->name('order.create');
    Route::get('order/{rowId}/{num}/update', [App\Http\Controllers\AjaxController::class,'update'])->name('order.update');
    Route::get('order/{rowId}/remove', [App\Http\Controllers\AjaxController::class,'remove'])->name('order.remove');
    Route::get('order/destroy', [App\Http\Controllers\AjaxController::class,'destroy'])->name('order.destroy');
});

Route::get('change/{lang}/languages', [App\Http\Controllers\AjaxController::class,'change'])->name('languages.change');

//Route::get('lien-he.html', [App\Http\Controllers\ContactController::class,'index']);
//Route::get('contact.html', [App\Http\Controllers\ContactController::class,'index'])->name('contact.index');
Route::post('contact', [App\Http\Controllers\ContactController::class,'store'])->name('send.contact');

Route::get('tag/{alias}',[App\Http\Controllers\SearchController::class,'tag'])->name('tag.show');
Route::get('search', [App\Http\Controllers\SearchController::class,'search'])->name('search');

Route::resource('comments',CommentController::class);

Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::post('maintenance',[App\Http\Controllers\HomeController::class,'maintenance'])->name('maintenance');
Route::get('{slug}.html', [App\Http\Controllers\HomeController::class,'translation'])->name('slug');

Auth::routes();

Route::fallback(function(){
    return abort(404);
});
