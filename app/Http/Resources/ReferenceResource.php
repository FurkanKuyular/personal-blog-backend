<?php

namespace App\Http\Resources;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferenceResource extends JsonResource
{
    /** @var Reference */
    public $resource;
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->resource->title,
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'linkedin_profile_link' => $this->resource->linkedin_profile_link,
            'user' => [
                'id' => $this->resource->user->id,
            ],
        ];
    }
}
