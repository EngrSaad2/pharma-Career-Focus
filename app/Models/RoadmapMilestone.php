<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapMilestone extends Model
{
    protected $fillable = [
        'roadmap_id',
        'phase_name',
        'title',
        'description',
        'resource_recommendation',
        'milestone_order',
        'is_completed',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
        ];
    }

    public function roadmap()
    {
        return $this->belongsTo(CareerRoadmap::class, 'roadmap_id');
    }
}
