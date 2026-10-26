<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationBooking extends Model
{
    protected $fillable = [
        'user_id',
        'consultant_id',
        'service_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'client_name',
        'client_email',
        'client_phone',
        'current_qualification',
        'target_goal',
        'notes',
        'meeting_link',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
