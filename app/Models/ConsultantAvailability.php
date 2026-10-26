<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultantAvailability extends Model
{
    protected $fillable = [
        'consultant_id',
        'day_of_week',
        'start_time',
        'end_time',
        'slot_duration_minutes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}
