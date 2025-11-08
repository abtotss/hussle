<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Form data passed to the Mailable and view.
     *
     * @var array
     */
    public array $data;

    /**
     * Create a new message instance.
     *
     * @param  array  $data  // expects keys: name, email, subject, message (at minimum)
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Use the sender's email as reply-to if available, otherwise fall back to the app mail-from.
        $replyToEmail = $this->data['email'] ?? config('mail.from.address');

        // Optionally set a friendly "from" name/address. If you want to set custom from:
        // -> from(new Address('no-reply@yourdomain.com', 'HussleTools'))
        return new Envelope(
            subject: 'New contact form submission: ' . ($this->data['subject'] ?? 'No subject'),
            replyTo: [
                new Address($replyToEmail),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact', // resources/views/emails/contact.blade.php
            with: [
                'data' => $this->data,
            ],
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
