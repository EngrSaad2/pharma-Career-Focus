<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'title',
        'current_company',
        'specialization',
        'qualifications',
        'experience_years',
        'avatar',
        'bio',
        'areas_of_expertise',
        'hourly_rate',
        'rating',
        'reviews_count',
        'consultation_types',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'areas_of_expertise' => 'array',
            'consultation_types' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'rating' => 'decimal:2',
            'hourly_rate' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availabilities()
    {
        return $this->hasMany(ConsultantAvailability::class);
    }

    public function bookings()
    {
        return $this->hasMany(ConsultationBooking::class);
    }
}
