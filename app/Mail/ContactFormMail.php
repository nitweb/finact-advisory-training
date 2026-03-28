<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        $name = strtoupper($this->message['name']);
        $subject = $this->message['subject'];
        $formattedSubject = " [{$name}] . {$subject}";
        
        return $this->subject($formattedSubject)
                    ->view('emails.contact_form')
                    ->with(['data' => $this->message]);
    }
}
