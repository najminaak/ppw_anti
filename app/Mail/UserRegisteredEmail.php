<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function build() {
        return $this->subject('Pendaftaran Berhasil')
            ->view('emails.user_registered');
    }
}
