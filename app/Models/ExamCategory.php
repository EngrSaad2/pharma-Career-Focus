<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'default_time_minutes',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'category_id')->where('is_active', true);
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'category_id');
    }
}
