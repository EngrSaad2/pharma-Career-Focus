<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'avatar',
        'headline',
        'bio',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isConsultant(): bool
    {
        return $this->role === 'consultant';
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function consultant()
    {
        return $this->hasOne(Consultant::class);
    }

    public function bookings()
    {
        return $this->hasMany(ConsultationBooking::class);
    }

    public function assessments()
    {
        return $this->hasMany(CareerAssessment::class);
    }

    public function roadmaps()
    {
        return $this->hasMany(CareerRoadmap::class);
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function vivaProgress()
    {
        return $this->hasMany(UserVivaProgress::class);
    }

    public function interviewProgress()
    {
        return $this->hasMany(UserInterviewProgress::class);
    }
}
