<?php

namespace App\Http\Resources;

use App\Models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpertiseResource extends JsonResource
{
    /** @var Expertise */
    public $resource;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'start_date' => $this->resource->start_date->format('Y-m'),
            'end_date' => $this->resource->end_date?->format('Y-m'),
            'user' => [
                'id' => $this->resource->user->id,
            ]
        ];
    }
}
