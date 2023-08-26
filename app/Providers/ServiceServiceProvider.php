<?php

namespace App\Providers;

use App\Service\Contacts\ContactInterface;
use App\Service\Contacts\ContactService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->app->bind(ContactInterface::class, ContactService::class);
    }
}
