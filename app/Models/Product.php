<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'line',
        'slug',
        'sku',
        'description',
        'short_description',
        'type',
        'panel',
        'control_type',
        'power_supply',
        'opening_side',
        'width',
        'depth',
        'height',
        'weight',
        'number_of_trays',
        'tray_size',
        'distance_between_trays',
        'voltage',
        'electric_power',
        'max_gas_power',
        'frequency',
        'consumption_kwh',
        'co2_emission',
        'energy_star_certified',
        'configurator_image',
        'list_image',
        'features',
        'card_info',
        'video_url',
        'price',
        'is_active',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'category_id' => 'integer',
            'width' => 'decimal:2',
            'depth' => 'decimal:2',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'electric_power' => 'decimal:2',
            'max_gas_power' => 'decimal:2',
            'consumption_kwh' => 'decimal:2',
            'co2_emission' => 'decimal:2',
            'energy_star_certified' => 'boolean',
            'features' => 'array',
            'card_info' => 'array',
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessory::class, 'product_accessories')
            ->withPivot('quantity', 'is_default', 'sort_order')
            ->withTimestamps();
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
