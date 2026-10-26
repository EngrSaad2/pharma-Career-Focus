<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarEmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'seminar_registration_id',
        'email_type',
        'recipient_email',
        'subject',
        'status',
        'error_message',
        'sent_by_user_id',
    ];

    public function registration()
    {
        return $this->belongsTo(SeminarRegistration::class, 'seminar_registration_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by_user_id');
    }
}
