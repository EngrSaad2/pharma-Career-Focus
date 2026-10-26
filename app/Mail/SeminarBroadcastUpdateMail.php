<?php

namespace App\Mail;

use App\Models\Seminar;
use App\Models\SeminarRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeminarBroadcastUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $seminar;
    public $registration;
    public $messageSubject;
    public $messageContent;

    public function __construct(Seminar $seminar, SeminarRegistration $registration, string $subject, string $content)
    {
        $this->seminar = $seminar;
        $this->registration = $registration;
        $this->messageSubject = $subject;
        $this->messageContent = $content;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->messageSubject . ' - ' . $this->seminar->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.seminars.broadcast-update',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
