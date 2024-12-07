<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            $menus = Category::all();
            $count_cart = 0;
            if (Auth::check()) {
                $count_cart = Cart::where('user_id', Auth::user()->id)->count();
            }
            $view->with('menus', $menus)->with('count_cart', $count_cart);
        });
    }
}
