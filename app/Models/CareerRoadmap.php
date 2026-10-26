<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRoadmap extends Model
{
    protected $fillable = [
        'user_id',
        'career_path_id',
        'target_role_title',
        'experience_level',
        'target_timeline_months',
        'progress_percent',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function careerPath()
    {
        return $this->belongsTo(CareerPath::class);
    }

    public function milestones()
    {
        return $this->hasMany(RoadmapMilestone::class, 'roadmap_id')->orderBy('milestone_order');
    }

    public function recalculateProgress()
    {
        $total = $this->milestones()->count();
        if ($total === 0) {
            $this->update(['progress_percent' => 0]);
            return 0;
        }

        $completed = $this->milestones()->where('is_completed', true)->count();
        $percent = (int) round(($completed / $total) * 100);
        $this->update(['progress_percent' => $percent]);
        return $percent;
    }
}
