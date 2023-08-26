<?php

namespace App\Console\Commands;

use App\Crawler\LaravelNewsBlogCrawler;
use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;

class GetLaravelNewsBlog extends Command
{
    protected $signature = 'app:get-laravel-news-blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get blogs from https://laravel-news.com';

    public function handle(): bool
    {
        Crawler::create()
            ->setCrawlObserver(new LaravelNewsBlogCrawler())
            ->startCrawling('https://laravel-news.com/blog');

        return self::SUCCESS;
    }
}
