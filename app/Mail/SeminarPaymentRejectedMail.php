<?php

namespace App\Mail;

use App\Models\SeminarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeminarPaymentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $seminar;
    public $reason;

    public function __construct(SeminarRegistration $registration, string $reason = '')
    {
        $this->registration = $registration->load('seminar');
        $this->seminar = $registration->seminar;
        $this->reason = $reason ?: $registration->rejection_reason;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Important: Payment Verification Update - ' . $this->seminar->title . ' [' . $this->registration->registration_reference . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seminars.payment-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
