<?php

namespace App\Mail;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewServiceWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    // Deklarasikan properti publik di sini
    public Service $service;
    public string $cpanelUsername;
    public string $cpanelPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(Service $service, string $cpanelUsername, string $cpanelPassword)
    {
        // Set nilainya di dalam constructor
        $this->service = $service;
        $this->cpanelUsername = $cpanelUsername;
        $this->cpanelPassword = $cpanelPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Layanan Hosting Anda Telah Diaktifkan!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.services.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}