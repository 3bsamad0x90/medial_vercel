<?php

namespace App\Http\Resources\blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang');
        return [
            'id' => $this->id,
            'title' => $this['title_' . $lang],
            'description' => $this['description_' . $lang],
            'image' => $this->photoLink(),
        ];
    }
}
