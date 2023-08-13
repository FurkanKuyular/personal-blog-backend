<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('app:get-laravel-news-blog');
    }
}
