<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVivaProgress extends Model
{
    protected $table = 'user_viva_progress';

    protected $fillable = [
        'user_id',
        'viva_question_id',
        'is_bookmarked',
        'is_practised',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_bookmarked' => 'boolean',
            'is_practised' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(VivaQuestion::class, 'viva_question_id');
    }
}
