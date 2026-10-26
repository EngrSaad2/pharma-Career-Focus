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
    public static function getAdminEmails(): array
    {
        $raw = SiteSetting::get(
            'admin_notification_email',
            config('mail.admin_address', env('ADMIN_NOTIFICATION_EMAIL', 'engr.saad477@gmail.com,bashar3074@gmail.com,abashar.qo@acmeglobal.com'))
        );

        if (empty($raw)) {
            return ['engr.saad477@gmail.com', 'bashar3074@gmail.com', 'abashar.qo@acmeglobal.com'];
        }

        $emails = preg_split('/[\s,;]+/', trim($raw));
        $validEmails = array_values(array_filter($emails, function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }));

        return !empty($validEmails)
            ? $validEmails
            : ['engr.saad477@gmail.com', 'bashar3074@gmail.com', 'abashar.qo@acmeglobal.com'];
    }

    public static function getAdminEmail(): string
    {
        $emails = static::getAdminEmails();
        return $emails[0] ?? 'engr.saad477@gmail.com';
    }

    public static function notifyNewUser(User $user): void
    {
        try {
            $adminEmails = static::getAdminEmails();
            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new NewUserRegistrationMail($user));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin new user email alert: ' . $e->getMessage());
        }
    }

    public static function notifyNewContact(ContactMessage $contactMessage): void
    {
        try {
            $adminEmails = static::getAdminEmails();
            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new NewContactMessageMail($contactMessage));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin contact message email alert: ' . $e->getMessage());
        }
    }

    public static function notifyNewBooking(ConsultationBooking $booking): void
    {
        try {
            $adminEmails = static::getAdminEmails();
            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new NewBookingNotificationMail($booking));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending admin booking notification email alert: ' . $e->getMessage());
        }
    }
}
