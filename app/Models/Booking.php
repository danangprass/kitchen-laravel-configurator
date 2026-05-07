<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'address',
        'preferred_date_start',
        'preferred_date_end',
        'oven_interest',
        'meals_per_day',
        'status',
        'notes',
    ];

    protected $casts = [
        'preferred_date_start' => 'date',
        'preferred_date_end' => 'date',
        'meals_per_day' => 'integer',
    ];
}
