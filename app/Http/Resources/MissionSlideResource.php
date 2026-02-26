<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionSlideResource extends JsonResource
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
            'image' => url($this->image),
            'title' => $this->title,
            'description' => $this->description,
            'sequence' => $this->sequence,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
