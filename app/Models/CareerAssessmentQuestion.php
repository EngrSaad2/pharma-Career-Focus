<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerAssessmentQuestion extends Model
{
    protected $fillable = [
        'step_number',
        'question_text',
        'description',
        'input_type',
        'options',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
