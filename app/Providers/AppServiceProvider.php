<?php

namespace App\Providers;

use App\Models\Category;
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
        if (Auth::guard('admin')) {
            $urlArray = explode("/", parse_url(request()->url(), PHP_URL_PATH));
            $prevUrl = implode('/', array_slice($urlArray, 0, count($urlArray) - 1));
            View::share(compact('urlArray', 'prevUrl'));
        }

        if (Auth::guard('web')) {
            $categories = \App\Models\Category::withCount('products')->get();
            View::share(compact('categories'));
        }
    }
}
