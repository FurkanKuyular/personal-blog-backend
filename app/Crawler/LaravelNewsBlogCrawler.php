<?php

namespace App\Crawler;

use App\Enum\PostType;
use App\Enum\User;
use App\Events\Post\PostCreated;
use App\Models\Post;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Symfony\Component\DomCrawler\Crawler;

class LaravelNewsBlogCrawler extends CrawlObserver
{
    private Crawler $node;

    public function crawled(UriInterface $url, ResponseInterface $response, UriInterface $foundOnUrl = null, string $linkText = null,): void
    {
        $crawler = new Crawler($response->getBody());

        $blogs = $crawler->filter('li.mb-6.group.group-link-underline')
            ->each(function (Crawler $node) use ($url): array {
                $this->node = $node;

                return [
                    'title' => $this->getTitle(),
                    'body' => $this->getSummaryText(),
                    'post_link' => sprintf('https://%s%s', $url->getHost(), $this->getBlogPath()),
                    'post_image_html' => $this->getPictureHtml(),
                ];
            });

        foreach ($blogs as $blog) {
            $post = Post::query()->updateOrCreate(
                [
                    'title' => self::removeNbsp($blog['title']),
                    'post_link' => $blog['post_link'],
                ],
                [
                    'body' => $blog['body'],
                    'post_image_html' => $blog['post_image_html'],
                    'user_id' => User::ADMIN_USER->value,
                    'post_type_id' => PostType::LARAVEL_NEWS->value,
                    'is_active' => true,
                ],
            );

            if ($post->wasRecentlyCreated) {
                PostCreated::dispatch($post);
            }
        }

        exit();
    }

    public function crawlFailed(UriInterface $url, RequestException $requestException, UriInterface $foundOnUrl = null, string $linkText = null,): void
    {
        logger()->error(sprintf('[%s][%s]: %s', __CLASS__, __METHOD__, $requestException));
    }

    private function getBlogPath(): string
    {
        return $this->node
            ->filter('a')
            ->attr('href');
    }
    private function getPictureHtml(): ?string
    {
        $this->node
            ->filter('a')
            ->filter('div.block')
            ->filter('picture')
            ->filter('source')
            ->getNode(0)
            ->setAttribute('srcset',
                $this->node
                    ->filter('a')
                    ->filter('div.block')
                    ->filter('picture')
                    ->filter('source')
                    ->attr('data-srcset')
            );

        return $this->node->filter('a div.block picture')->html();
    }

    private function getTitle(): string
    {
        return $this->node
            ->filter('a')
            ->filter('div.mt-4')
            ->filter('div.flex')
            ->filter('h4.text-black')
            ->filter('span')
            ->innerText();
    }

    private function getSummaryText(): string
    {
        return $this->node
            ->filter('a')
            ->filter('div.mt-4')
            ->filter('div.flex.flex-col')
            ->filter('p.mt-2')
            ->text();
    }

    private static function removeNbsp(string $text): string
    {
        $string = htmlentities($text, null, 'utf-8');
        $content = str_replace("&nbsp;", ' ', $string);
        return html_entity_decode($content);
    }
}
