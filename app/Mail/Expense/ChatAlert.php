<?php

namespace App\Mail\Expense;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChatAlert extends Mailable
{
    use Queueable, SerializesModels;

    private string $reference;
    private string $name;
    private string $id;

    /**
     * @param String $reference
     * @param String $name
     * @param String $id
     */
    public function __construct(string $reference, string $name, string $id)
    {
        $this->reference = $reference;
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Create a new message instance.
     */

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request Comment Alert',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'expense.mail.chat-alert',
            with: [
                'reference' => $this->reference,
                'name' => $this->name,
                'id' => $this->id,
            ]
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
