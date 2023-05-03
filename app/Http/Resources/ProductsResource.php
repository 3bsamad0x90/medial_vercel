<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang');
        return
        [
            'id' => $this->id,
            'name' => $this['title_' . $lang],
            'description' => $this['description_' . $lang],
            'image' => $this->photoLink(),
        ];
    }
}
