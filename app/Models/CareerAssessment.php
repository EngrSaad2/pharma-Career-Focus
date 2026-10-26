<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'session_token',
        'full_name',
        'email',
        'education_level',
        'specialization',
        'experience_level',
        'preferred_environment',
        'interests',
        'strengths',
        'career_goals',
        'responses',
        'recommended_paths',
        'recommended_services',
        'action_plan',
        'guidance_summary',
        'is_saved',
    ];

    protected function casts(): array
    {
        return [
            'interests' => 'array',
            'strengths' => 'array',
            'career_goals' => 'array',
            'responses' => 'array',
            'recommended_paths' => 'array',
            'recommended_services' => 'array',
            'action_plan' => 'array',
            'is_saved' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
