<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('laravelNewsFeed', function () {
            return Http::acceptJson()
                ->contentType('application/json')
                ->withHeaders([
                    'User-Agent' => null,
                ])
                ->baseUrl(config('app.laravel_news_feed_url'));
        });
    }
}
