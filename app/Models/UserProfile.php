<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'education_level',
        'university',
        'graduation_year',
        'current_status',
        'current_company',
        'target_department',
        'target_role',
        'years_experience',
        'linkedin_url',
        'cv_path',
        'preferred_learning_mode',
        'career_summary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
