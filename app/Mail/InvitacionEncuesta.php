<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitacionEncuesta extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $encuesta;

    /**
     * Create a new message instance.
     */
    public function __construct($mensaje, $encuesta)
    {
        $this->mensaje = $mensaje;
        $this->encuesta = $encuesta;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitación a Encuesta',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Invitación a Encuesta')
                    ->view('emails.invitacion-encuesta'); // Asegúrate de que la vista sea correcta
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