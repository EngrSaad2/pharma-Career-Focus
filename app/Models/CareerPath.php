<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerPath extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'icon',
        'badge',
        'summary',
        'overview',
        'required_skills',
        'relevant_qualifications',
        'possible_entry_points',
        'recommended_preparation',
        'typical_day',
        'salary_range',
        'work_environment',
        'experience_level',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'required_skills' => 'array',
            'relevant_qualifications' => 'array',
            'possible_entry_points' => 'array',
            'recommended_preparation' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(CareerCategory::class, 'category_id');
    }

    public function roadmaps()
    {
        return $this->hasMany(CareerRoadmap::class);
    }
}
