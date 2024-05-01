<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\FamilyInvitations;
use App\Models\User;

class FamilyInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invitation;
    public $username;
    /**
     * Create a new message instance.
     */
    public function __construct(FamilyInvitations $invitation, string $username)
    {
        $this->invitation = $invitation;
         $this->username = $username;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Family Invitation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
    return new Content(
            view: 'mails.joinFamilyRequest',
            with: [
                'invitation' => $this->invitation,
                'username' => $this->username
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
