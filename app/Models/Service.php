<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'tag',
        'summary',
        'description',
        'target_audience',
        'expected_outcomes',
        'duration_minutes',
        'price',
        'currency',
        'delivery_mode',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'expected_outcomes' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(ConsultationBooking::class);
    }
}
