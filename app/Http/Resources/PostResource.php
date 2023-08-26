<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /** @var Post */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'body' => $this->resource->body,
            'post_link' => $this->resource->post_link,
            'post_image_html' => $this->resource->post_image_html,
            'is_active' => $this->resource->is_active,
            'post_type' => [
                'id' => $this->resource->postType->id,
                'name' => $this->resource->postType->name,
            ],
            'user' => [
                'id' => $this->resource->user->id,
            ],
        ];
    }
}
