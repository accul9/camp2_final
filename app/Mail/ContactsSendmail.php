<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactsSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $name;
    private $title;
    private $body;


    /**
     * Create a new message instance.
     */
    public function __construct($inputs)
    {
        $this->email = $inputs['email'];
        $this->name = $inputs['name'];
        $this->title = $inputs['title'];
        $this->body = $inputs['body'];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('contabile@gmail.com')
            ->subject('CampMeshi自動返信メール')
            ->view('contact.mail')
            ->with([
                'email' => $this->email,
                'name' => $this->name,
                'title' => $this->title,
                'body' => $this->body,
            ]);
    }
}
