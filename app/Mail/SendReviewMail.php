<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Notifications\Messages\MailMessage;

class SendReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    private $message;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $filepath)
    {
        $this->user = $user;
        $this->subject = 'Video review by student';
        $this->message = (new MailMessage)->subject($this->subject);

        $this->message->line('Student last finish course and last review');
        
        $this->attach(public_path('files/Polityka prywatności serwisu internetowego.pdf'), [
            'as' => 'sample.pdf',
            'mime' => 'application/pdf',
        ]);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'slot' => $this->message,
        ];
        return $this->markdown('emails.feedback')->subject($this->subject)->with($data);
    }
}
