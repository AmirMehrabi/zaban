<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
Use Carbon\Carbon;
use App\Group;
use App\Post;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        view()->composer(['layouts.simple', 'home-page'], function ($view) {
            $view->with('groups', Group::orderBy('created_at', 'desc')->take(4)->get());
            $view->with('roots', Post::roots()->take(3)->get());
            $view->with('setting', Setting::first());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
