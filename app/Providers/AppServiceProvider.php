<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $urlArray = (explode("/", str_replace(config("app.url"), "", request()->url())));
        $prevUrl = implode('/', array_slice($urlArray, 0, count($urlArray) - 1));
        View::share(compact('urlArray', 'prevUrl'));
    }
}
