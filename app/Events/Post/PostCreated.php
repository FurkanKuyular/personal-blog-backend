<?php

namespace App\Events\Post;

use App\Events\HasPost;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements HasPost, ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(protected Post $post)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('post-created-channel'),
        ];
    }

    public function broadcastWith(): array
    {
        return ['post' => $this->post->toArray()];
    }

    public function broadcastAs(): string
    {
        return 'PostCreated';
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
