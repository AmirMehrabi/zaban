<?php

namespace App\Providers;

use Illuminate\Pagination\BootstrapFourPresenter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      Paginator::presenter(function($paginator)
      {
          return new BootstrapFourPresenter($paginator);
      });
    }
}
