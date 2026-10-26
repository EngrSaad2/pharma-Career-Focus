<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'session_title',
        'total_questions',
        'correct_answers',
        'score_percentage',
        'time_taken_seconds',
        'user_answers',
        'passed',
    ];

    protected function casts(): array
    {
        return [
            'user_answers' => 'array',
            'passed' => 'boolean',
            'score_percentage' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ExamCategory::class, 'category_id');
    }
}
