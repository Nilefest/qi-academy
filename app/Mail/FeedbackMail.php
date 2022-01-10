<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Notifications\Messages\MailMessage;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject = 'Feedback message', $message_data = [])
    {
        $this->subject = $subject;

        $this->message = (new MailMessage)->subject($subject);
        $this->message->line('Second line 1 test')->subject($subject);
        foreach($message_data as $row)
            $this->message->line($row);
        $this->message->action('Button-link', 'https://www.google.com/')
            ->line('Last line');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [ 
            'slot' => $this->message 
        ];
        return $this->markdown('emails.feedback')->subject($this->subject)->with($data);
    }
}
