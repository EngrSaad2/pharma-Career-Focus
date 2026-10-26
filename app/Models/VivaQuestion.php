<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VivaQuestion extends Model
{
    protected $fillable = [
        'domain',
        'topic',
        'question_text',
        'model_answer',
        'interviewer_tip',
        'key_points',
        'difficulty',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'key_points' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function progress()
    {
        return $this->hasMany(UserVivaProgress::class);
    }
}
