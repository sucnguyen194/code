<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Discount;
use App\Models\Invoice;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SocialIdentity;
use App\Models\Support;
use App\Models\Tags;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Relation::morphMap([
            'products'          => Product::class,
            'posts'             => Post::class,
            'menus'             => Menu::class,
            'settings'          => Setting::class,
            'photos'            => Photo::class,
            'translations'      => Translation::class,
            'contacts'          => Contact::class,
            'comments'          => Comment::class,
            'categories'        => Category::class,
            'orders'            => Order::class,
            'supports'          => Support::class,
            'users'             => User::class,
            'admins'            => Admin::class,
            'languages'         => Language::class,
            'discounts'         => Discount::class,
            'invoices'          => Invoice::class,
            'socialidentities'  => SocialIdentity::class,
            'tags'              => Tags::class

        ]);
    }
}
