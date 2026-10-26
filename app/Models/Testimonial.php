<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'previous_status',
        'avatar',
        'content',
        'rating',
        'service_tag',
        'is_demo',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_demo' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }
}
