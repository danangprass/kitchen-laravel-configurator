<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'accessory_type' => $this->accessory_type,
            'width' => $this->width,
            'depth' => $this->depth,
            'height' => $this->height,
            'weight' => $this->weight,
            'voltage' => $this->voltage,
            'electric_power' => $this->electric_power,
            'min_flow' => $this->min_flow,
            'max_flow' => $this->max_flow,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'products' => ProductCollection::make($this->whenLoaded('products')),
            'accessoryImages' => AccessoryImageCollection::make($this->whenLoaded('accessoryImages')),
        ];
    }
}
