<?php

namespace App\Mail;

use App\Models\ConsultationBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(ConsultationBooking $booking)
    {
        $this->booking = $booking->load(['service', 'consultant']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Consultation Booking #' . $this->booking->id . ': ' . $this->booking->client_name . ' (' . ($this->booking->service->title ?? 'Session') . ')',
            replyTo: [new Address($this->booking->client_email, $this->booking->client_name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin.new-booking',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
