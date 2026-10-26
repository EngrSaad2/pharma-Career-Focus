<?php

namespace App\Mail;

use App\Models\SeminarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeminarPaymentVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $seminar;

    public function __construct(SeminarRegistration $registration)
    {
        $this->registration = $registration->load('seminar');
        $this->seminar = $registration->seminar;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✓ Registration Confirmed: ' . $this->seminar->title . ' [' . $this->registration->registration_reference . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seminars.payment-verified',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
