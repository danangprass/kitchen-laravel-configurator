<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $fillable = [
        'type', 'title', 'subtitle', 'content', 'background_type',
        'background_data', 'cta_text', 'cta_url', 'product_ids',
        'line_family', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'content' => 'array',
        'product_ids' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function products()
    {
        if (empty($this->product_ids)) {
            return collect();
        }

        return Product::whereIn('id', $this->product_ids)
            ->orderBy('sort_order')
            ->get();
    }
}
