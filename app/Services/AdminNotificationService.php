<?php

namespace App\Services;

use App\Mail\NewBookingNotificationMail;
use App\Mail\NewContactMessageMail;
use App\Mail\NewUserRegistrationMail;
use App\Models\ConsultationBooking;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminNotificationService
{
    public static function getAdminEmail(): string
    {
        return SiteSetting::get(
            'admin_notification_email',
            config('mail.admin_address', env('ADMIN_NOTIFICATION_EMAIL', 'engr.saad477@gmail.com'))
        );
    }

    public static function notifyNewUser(User $user): void
    {
        try {
            $adminEmail = static::getAdminEmail();
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new NewUserRegistrationMail($user));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin new user email alert: ' . $e->getMessage());
        }
    }

    public static function notifyNewContact(ContactMessage $contactMessage): void
    {
        try {
            $adminEmail = static::getAdminEmail();
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new NewContactMessageMail($contactMessage));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin contact message email alert: ' . $e->getMessage());
        }
    }

    public static function notifyNewBooking(ConsultationBooking $booking): void
    {
        try {
            $adminEmail = static::getAdminEmail();
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new NewBookingNotificationMail($booking));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin booking notification email alert: ' . $e->getMessage());
        }
    }
}
