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
use App\Models\Tag;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
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

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

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
            'tags'              => Tag::class

        ]);
    }
}
