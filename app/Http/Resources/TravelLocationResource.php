<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'alias' => $this->alias,
            'country' => $this->country,
            'city' => $this->city,
            'year' => $this->publish_up?->year,
            'image' => $this->images,
            'coordinates' => $this->coordinates,
            'group_stories' => $this->group_stories
        ];
    }
}
