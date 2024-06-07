<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->view('emails.contact')
                    ->with([
                        'name' => $this->contact['name'],
                        'email' => $this->contact['email'],
                        'thoughts' => $this->contact['thoughts']
                    ]);
    }
}
