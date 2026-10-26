<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterviewProgress extends Model
{
    protected $table = 'user_interview_progress';

    protected $fillable = [
        'user_id',
        'interview_question_id',
        'is_bookmarked',
        'is_prepared',
        'user_notes',
    ];

    protected function casts(): array
    {
        return [
            'is_bookmarked' => 'boolean',
            'is_prepared' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(InterviewQuestion::class, 'interview_question_id');
    }
}
