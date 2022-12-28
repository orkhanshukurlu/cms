<?php

namespace App\Providers;

use App\Models\Social;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        view()->composer('frontend.includes.footer', function ($view) {
            $view->with('socials', Social::active()->get(['name', 'link']));
        });
    }
}
