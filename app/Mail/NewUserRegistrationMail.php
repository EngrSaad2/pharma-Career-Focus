<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user->load('profile');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Candidate Registration: ' . $this->user->name . ' | Pharma Career Compass',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin.new-user',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
