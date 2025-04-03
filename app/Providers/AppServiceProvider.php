<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        $urlArray = explode("/", parse_url(request()->url(), PHP_URL_PATH));
        $prevUrl = implode('/', array_slice($urlArray, 0, count($urlArray) - 1));
        View::share(compact('urlArray', 'prevUrl'));
        $categories = \App\Models\Category::withCount('products')->orderBy('id', 'DESC')->get();
        View::share(compact('categories'));
    }
}
