<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header','App\Http\ViewComposers\HeaderComposer');
        view()->composer('layouts.footer','App\Http\ViewComposers\FooterComposer');
        view()->composer('admin.layouts.layout','App\Http\ViewComposers\LayoutComposer');

        view()->composer('partials.sidebar', 'App\Http\ViewComposers\SidebarComposer');
        view()->composer('partials.register', 'App\Http\ViewComposers\RegisterComposer');
        view()->composer('partials.choises', 'App\Http\ViewComposers\ChoiseComposer');

        view()->composer('ladipage.about', 'App\Http\ViewComposers\AboutComposer');
        view()->composer('ladipage.partner', 'App\Http\ViewComposers\LadiPartnerComposer');
        view()->composer('ladipage.aboutUs', 'App\Http\ViewComposers\LadiAboutUsComposer');
        view()->composer('ladipage.question', 'App\Http\ViewComposers\QuessionComposer');

    }
}
