<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestion extends Model
{
    protected $fillable = [
        'target_role',
        'category',
        'question_text',
        'context_explanation',
        'star_situation',
        'star_task',
        'star_action',
        'star_result',
        'model_answer',
        'recruiter_red_flags',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function progress()
    {
        return $this->hasMany(UserInterviewProgress::class);
    }
}
