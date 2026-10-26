<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'seminar_id',
        'registration_reference',
        'name',
        'email',
        'phone',
        'organization',
        'designation',
        'participation_type',
        'amount_payable',
        'verified_amount',
        'payment_method',
        'transaction_id',
        'sender_number',
        'payment_proof',
        'payment_status',
        'registration_status',
        'rejection_reason',
        'admin_notes',
        'verified_at',
        'verified_by_user_id',
        'confirmation_sent_at',
        'confirmation_sent_count',
        // Virtual / Aliased attributes
        'full_name',
        'registration_fee',
        'payment_screenshot',
    ];

    protected function casts(): array
    {
        return [
            'amount_payable' => 'decimal:2',
            'verified_amount' => 'decimal:2',
            'verified_at' => 'datetime',
            'confirmation_sent_at' => 'datetime',
            'confirmation_sent_count' => 'integer',
        ];
    }

    public function seminar()
    {
        return $this->belongsTo(Seminar::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }

    public function emailLogs()
    {
        return $this->hasMany(SeminarEmailLog::class);
    }

    // --- Aliases for attribute compatibility ---

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name,
            set: fn ($value) => ['name' => $value]
        );
    }

    protected function registrationFee(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->amount_payable,
            set: fn ($value) => ['amount_payable' => $value]
        );
    }

    protected function paymentScreenshot(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->payment_proof,
            set: fn ($value) => ['payment_proof' => $value]
        );
    }
}
