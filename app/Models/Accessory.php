<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accessory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'accessory_type',
        'configurator_position',
        'configurator_image',
        'list_image',
        'list_image_alt',
        'commercial_name',
        'accessory_line',
        'accessory_category',
        'accessory_subcategory',
        'labels',
        'width',
        'depth',
        'height',
        'weight',
        'voltage',
        'electric_power',
        'min_flow',
        'max_flow',
        'quantity',
        'price',
        'is_active',
        'is_featured',
        'prefooter',
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
            'width' => 'decimal:2',
            'depth' => 'decimal:2',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
            'electric_power' => 'decimal:2',
            'min_flow' => 'decimal:2',
            'max_flow' => 'decimal:2',
            'labels' => 'array',
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'prefooter' => 'boolean',
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_accessories')
            ->withPivot('quantity', 'is_default', 'sort_order')
            ->withTimestamps();
    }

    public function accessoryImages(): HasMany
    {
        return $this->hasMany(AccessoryImage::class);
    }
}
