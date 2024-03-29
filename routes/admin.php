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
Route::group(['as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    /**
     * Login Admin
     */
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::middleware('auth:admin')->group(function () {
        /**
         * Logout Admin
         */
        Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
        /**
         * Dashboard
         */
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        /**
         * Logs
         */
        Route::get('logs', [App\Http\Controllers\Admin\DashboardController::class, 'logs'])->name('logs');
        /**
         * Roles
         */
        Route::get('data/roles', [App\Http\Controllers\Admin\RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class);
        /**
         * Permissions
         */
        Route::get('data/permissions', [App\Http\Controllers\Admin\PermissionsController::class, 'data'])->name('permissions.data');
        Route::resource('permissions', PermissionsController::class);
        /**
         * Admin
         */
        Route::get('data/admins', [App\Http\Controllers\Admin\AdminController::class, 'data'])->name('admins.data');
        Route::resource('admins', AdminController::class);
        /**
         * Tags
         */
        Route::get('add/tags', [App\Http\Controllers\Admin\TagController::class, 'ajax_create'])->name('tags.add');
        Route::post('add/tags', [App\Http\Controllers\Admin\TagController::class, 'add'])->name('tags.add');
        Route::get('data/tags', [App\Http\Controllers\Admin\TagController::class, 'data'])->name('tags.data');
        Route::resource('tags', TagController::class);
        /**
         * Categories
         */
        Route::post('/ajax/store/categories', [App\Http\Controllers\Admin\CategoryController::class, 'ajaxStore'])->name('categories.ajax.store');
        Route::get('/data/categories', [App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('categories.data');
        Route::resource('categories', CategoryController::class);
        /**
         * Recruitments
         */
        Route::resource('/recruitments/categories', RecruitmentCategoryController::class, ['as' => 'recruitments']);
        Route::resource('/recruitments', RecruitmentController::class);
        /**
         * Video
         */
        Route::resource('/videos', VideoController::class, ['as' => 'posts']);
        /**
         * Galleries
         */
        Route::resource('/galleries', GalleryController::class, ['as' => 'posts']);
        /**
         * Pages
         */
        Route::resource('/pages', PageController::class, ['as' => 'posts']);
        /**
         * Post Categories
         */
        Route::resource('/posts/categories', PostCategoryController::class, ['as' => 'posts']);
        /**
         * Posts
         */
        Route::get('/data/posts/', [App\Http\Controllers\Admin\PostController::class, 'data'])->name('posts.data');
        Route::resource('posts', PostController::class);
        /**
         * Product Categories
         */
        Route::resource('/products/categories', ProductCategoryController::class, ['as' => 'products']);
        /**
         * Products
         */
        Route::get('data/products', [App\Http\Controllers\Admin\ProductController::class, 'data'])->name('products.data');
        Route::resource('products', ProductController::class);
        /**
         * Discounts
         */
        Route::get('data/discounts', [App\Http\Controllers\Admin\DiscountController::class, 'data'])->name('discounts.data');
        Route::get('discounts/{discount}/history', [App\Http\Controllers\Admin\DiscountController::class, 'history'])->name('discounts.history');
        Route::resource('discounts', DiscountController::class);
        /**
         * Attributes
         */
//        Route::get('attributes/{id}/render',[App\Http\Controllers\Admin\AttributeController::class,'render'])->name('attributes.render');
        Route::get('data/attributes', [App\Http\Controllers\Admin\AttributeController::class, 'data'])->name('attributes.data');
        Route::resource('attributes', AttributeController::class);
        /**
         * Filters
         */
        Route::get('data/filters', [App\Http\Controllers\Admin\FilterController::class, 'data'])->name('filters.data');
        Route::resource('filters', FilterController::class);
        /**
         * Photos
         */
        Route::get('data/photos', [App\Http\Controllers\Admin\PhotoController::class, 'data'])->name('photos.data');
        Route::resource('photos', PhotoController::class);
        /**
         * Menus
         */
        Route::get('/sort/menus', [App\Http\Controllers\Admin\MenuController::class, 'setMenuSort'])->name('ajax.menu.sort');
        Route::post('/append/menus', [App\Http\Controllers\Admin\MenuController::class, 'append'])->name('ajax.append.menu');
        Route::get('/menus/{position}/position', [App\Http\Controllers\Admin\MenuController::class, 'position'])->name('change.position.menu');
        Route::resource('menus', MenuController::class);
        /**
         * Supports
         */
        Route::resource('/questions', QuestionController::class, ['as' => 'supports']);
        Route::resource('/customers', CustomerController::class, ['as' => 'supports']);
        Route::get('data/supports', [App\Http\Controllers\Admin\SupportController::class, 'data'])->name('supports.data');
        Route::resource('supports', SupportController::class);
        /**
         * Orders
         */
        Route::get('data/orders', [App\Http\Controllers\Admin\OrderController::class, 'data'])->name('orders.data');
        Route::get('print/{id}/orders', [App\Http\Controllers\Admin\OrderController::class, 'print'])->name('orders.print');
        Route::resource('orders', OrderController::class);
        /**
         * Setting
         */
        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
        Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update']);
        /**
         * Contacts
         */
        Route::get('contacts/data', [App\Http\Controllers\Admin\ContactController::class, 'data'])->name('contacts.data');
        Route::resource('contacts', ContactController::class);
        /**
         * Users
         */
        Route::get('data/users', [App\Http\Controllers\Admin\UserController::class, 'data'])->name('users.data');
        Route::resource('users', UserController::class);
        /**
         * Edit website
         */
        Route::get('/load/sources', [App\Http\Controllers\Admin\SourceController::class, 'load'])->name('load.sources');
        Route::post('/push/sources', [App\Http\Controllers\Admin\SourceController::class, 'push'])->name('push.sources');
        Route::resource('sources', SourceController::class);
        /**
         * languages
         */
        Route::get('languages/{lang}/change', [App\Http\Controllers\Admin\LanguageController::class, 'change'])->name('languages.change');
        Route::post('languages/{id}/active', [App\Http\Controllers\Admin\LanguageController::class, 'active'])->name('languages.active');
        Route::get('languages/{lang}/translate', [App\Http\Controllers\Admin\LanguageController::class, 'translate'])->name('languages.translate');

        Route::get('languages/data/{lang}/translate', [App\Http\Controllers\Admin\LanguageController::class, 'dataTranslate'])->name('languages.translate.data');

        Route::get('languages/translate/{lang}/create', [App\Http\Controllers\Admin\LanguageController::class, 'createTranslate'])->name('languages.create.translate');

        Route::post('languages/translate/{lang}/create', [App\Http\Controllers\Admin\LanguageController::class, 'storeTranslate']);

        Route::get('languages/translate/edit', [App\Http\Controllers\Admin\LanguageController::class, 'editTranslate'])->name('languages.edit.translate');

        Route::get('languages/translate/delete', [App\Http\Controllers\Admin\LanguageController::class, 'deleteTranslate'])->name('languages.delete.translate');

        Route::post('languages/translate/item/{lang}/update', [App\Http\Controllers\Admin\LanguageController::class, 'updateTranslate'])->name('languages.update.item.translate');

        Route::get('languages/translate/import', [App\Http\Controllers\Admin\LanguageController::class, 'import'])->name('languages.import.translate');

        Route::post('languages/translate/import', [App\Http\Controllers\Admin\LanguageController::class, 'importTranslate']);

        Route::get('data/languages', [App\Http\Controllers\Admin\LanguageController::class, 'data'])->name('languages.data');

        Route::resource('languages', LanguageController::class);

        /**
         * comments
         */
        Route::get('data/comments', [App\Http\Controllers\Admin\CommentController::class, 'data'])->name('comments.data');
        Route::get('comments/{type}/list', [App\Http\Controllers\Admin\CommentController::class, 'list'])->name('comments.list');
        Route::get('comments/{type}/{id}/reply', [App\Http\Controllers\Admin\CommentController::class, 'reply'])->name('comments.reply');
        Route::resource('comments', CommentController::class);
        /**
         * Ajax Admin
         */
        Route::get('update/sort', [App\Http\Controllers\Admin\AjaxController::class, 'updateSort'])->name('ajax.data.sort');
        Route::get('update/public', [App\Http\Controllers\Admin\AjaxController::class, 'updatePublic'])->name('ajax.data.public');
        Route::get('update/status', [App\Http\Controllers\Admin\AjaxController::class, 'updateStatus'])->name('ajax.data.status');

    });
});
?>
