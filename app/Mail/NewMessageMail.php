<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public ?Message $message = null;

    /**
     * Create a new message instance.
     */
    public function __construct(?Message $message = null)
    {
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if (!$this->message) {
            Log::warning('NewMessageMail: Message is null in envelope()', [
                'class' => self::class,
            ]);
            return new Envelope(
                subject: 'New message',
            );
        }

        Log::info('NewMessageMail: Rendering envelope', [
            'message_id' => $this->message->id,
            'sender_name' => $this->message->sender->name ?? 'Unknown',
        ]);

        return new Envelope(
            subject: 'New message from ' . $this->message->sender->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if (!$this->message) {
            Log::warning('NewMessageMail: Message is null in content()', [
                'class' => self::class,
            ]);
            return new Content(
                markdown: 'emails.messages.new',
            );
        }

        Log::info('NewMessageMail: Preparing content', [
            'message_id' => $this->message->id,
            'template' => 'emails.messages.new',
        ]);

        return new Content(
            markdown: 'emails.messages.new',
            with: [
                'message' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
