<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'type' => $this->type,
            'panel' => $this->panel,
            'power_supply' => $this->power_supply,
            'width' => $this->width,
            'depth' => $this->depth,
            'height' => $this->height,
            'weight' => $this->weight,
            'number_of_trays' => $this->number_of_trays,
            'tray_size' => $this->tray_size,
            'distance_between_trays' => $this->distance_between_trays,
            'voltage' => $this->voltage,
            'electric_power' => $this->electric_power,
            'frequency' => $this->frequency,
            'consumption_kwh' => $this->consumption_kwh,
            'co2_emission' => $this->co2_emission,
            'energy_star_certified' => $this->energy_star_certified,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'accessories' => AccessoryCollection::make($this->whenLoaded('accessories')),
            'productImages' => ProductImageCollection::make($this->whenLoaded('productImages')),
        ];
    }
}
