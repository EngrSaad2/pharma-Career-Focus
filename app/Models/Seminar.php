<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Seminar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'topic',
        'category',
        'short_description',
        'full_description',
        'featured_image',
        'banner_image',
        'speaker_name',
        'speaker_designation',
        'speaker_bio',
        'speaker_avatar',
        'start_date',
        'start_time',
        'end_time',
        'registration_opens_at',
        'registration_closes_at',
        'participation_type',
        'registration_fee',
        'max_capacity',
        'venue_name',
        'venue_address',
        'venue_map_url',
        'online_meeting_url',
        'online_joining_instructions',
        'terms_conditions',
        'payment_instructions',
        'facebook_url',
        'status',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_featured',
        // Virtual/Aliased attributes
        'event_date',
        'max_participants',
        'meeting_url',
        'joining_instructions',
        'terms_and_conditions',
        'seo_meta_description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'registration_opens_at' => 'date',
            'registration_closes_at' => 'datetime',
            'registration_fee' => 'decimal:2',
            'max_capacity' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function registrations()
    {
        return $this->hasMany(SeminarRegistration::class);
    }

    public function confirmedRegistrations()
    {
        return $this->hasMany(SeminarRegistration::class)->where('registration_status', 'confirmed');
    }

    public function pendingRegistrations()
    {
        return $this->hasMany(SeminarRegistration::class)->whereIn('registration_status', ['pending_payment', 'pending_verification']);
    }

    public function waitlistRegistrations()
    {
        return $this->hasMany(SeminarRegistration::class)->where('registration_status', 'waitlisted');
    }

    // --- Aliases for attribute compatibility ---

    protected function eventDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_date,
            set: fn ($value) => ['start_date' => $value]
        );
    }

    protected function maxParticipants(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->max_capacity,
            set: fn ($value) => ['max_capacity' => $value]
        );
    }

    protected function meetingUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->online_meeting_url,
            set: fn ($value) => ['online_meeting_url' => $value]
        );
    }

    protected function joiningInstructions(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->online_joining_instructions,
            set: fn ($value) => ['online_joining_instructions' => $value]
        );
    }

    protected function termsAndConditions(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->terms_conditions,
            set: fn ($value) => ['terms_conditions' => $value]
        );
    }

    protected function seoMetaDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->seo_description,
            set: fn ($value) => ['seo_description' => $value]
        );
    }

    // --- Helper Methods ---

    public function isPubliclyVisible(): bool
    {
        return in_array($this->status, ['published', 'registration_open', 'registration_closed', 'completed']);
    }

    public function isRegistrationClosed(): bool
    {
        if (in_array($this->status, ['draft', 'registration_closed', 'completed', 'cancelled'])) {
            return true;
        }

        if ($this->registration_closes_at && $this->registration_closes_at->isPast()) {
            return true;
        }

        return false;
    }

    public function isRegistrationOpen(): bool
    {
        return !$this->isRegistrationClosed() && in_array($this->status, ['published', 'registration_open']);
    }

    public function confirmedCount(): int
    {
        return $this->confirmedRegistrations()->count();
    }

    public function availableSeats(): int
    {
        $confirmed = $this->confirmedCount();
        $capacity = $this->max_capacity ?: 100;
        return max(0, $capacity - $confirmed);
    }

    public function isFull(): bool
    {
        return $this->availableSeats() <= 0;
    }

    public function canRegister(): bool
    {
        return $this->isRegistrationOpen() && !$this->isFull();
    }
}
