<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'service_level',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public static function types(): array
    {
        return ['Dealer', 'Unox Office'];
    }

    public static function serviceLevels(): array
    {
        return ['Platinum', 'Gold', 'Silver', 'Authorized'];
    }
}
