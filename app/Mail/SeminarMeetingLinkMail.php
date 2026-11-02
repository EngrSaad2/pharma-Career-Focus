<?php

namespace App\Mail;

use App\Models\SeminarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeminarMeetingLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $meetingLink;
    public $sessionTime;
    public $customNote;
    public $targetTitle;

    public function __construct(
        SeminarRegistration $registration,
        string $meetingLink,
        ?string $sessionTime = null,
        ?string $customNote = null,
        string $targetTitle = 'Pharmaceutical Career Development Program (PCDP)'
    ) {
        $this->registration = $registration;
        $this->meetingLink = $meetingLink;
        $this->sessionTime = $sessionTime ?: '7:30 PM – 10:00 PM (BST)';
        $this->customNote = $customNote;
        $this->targetTitle = $targetTitle;
    }

    public function envelope(): Envelope
    {
        $subject = '🔴 Live Session Link: ' . ($this->registration->seminar->title ?? 'Pharmaceutical Career Development Program');

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seminars.meeting-link',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
