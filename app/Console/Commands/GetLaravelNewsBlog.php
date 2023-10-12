<?php

namespace App\Console\Commands;

use App\Enum\PostType;
use App\Enum\User;
use App\Events\Post\PostCreated;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Command\Command as CommandAlias;

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
        $response = Http::laravelNewsFeed()->get('/feed/json');

        if (!$response->ok()) {
            return CommandAlias::FAILURE;
        }

        $blogs = $response->json()['items']['items'];

        foreach ($blogs as $blog) {
            $post = Post::query()->firstOrCreate(
                [
                    'title' => $blog['title'],
                    'post_link' => $blog['url'],
                ],
                [
                    'body' => strip_tags($blog['excerpt']),
                    'post_image_url' => $blog['image'],
                    'user_id' => User::ADMIN_USER->value,
                    'post_type_id' => PostType::LARAVEL_NEWS->value,
                    'is_active' => true,
                ],
            );

            if ($post->wasRecentlyCreated) {
                PostCreated::dispatch($post);
            }
        }

        /*Crawler::create()
            ->setCrawlObserver(new LaravelNewsBlogCrawler())
            ->startCrawling('https://laravel-news.com/blog');*/

        return self::SUCCESS;
    }
}
