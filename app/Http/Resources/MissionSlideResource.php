<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'image' => $this->image ? url(Storage::url($this->image)) : null,
            'title' => $this->title,
            'description' => $this->description,
            'external_link' => $this->external_link,
            'sequence' => $this->sequence,
        ];
    }
}
