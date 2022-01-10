<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Notifications\Messages\MailMessage;

class SubscribesMail extends Mailable
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
    public function __construct($user, $subject, $articles = [])
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->message = (new MailMessage)->subject($subject);

        foreach($articles as $row){
            if($row['type'] === 'subject') $this->message->subject($row['value']);
            elseif($row['type'] === 'line') $this->message->line($row['value']);
            elseif($row['type'] === 'action') $this->message->subject($row['value']);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader('List-Unsubscribe', '<' . $this->user->getUnsubscribeLink() . '>, (Unsubscribe, please)<mailto:support@qilabel.com?subject=unsubscribe>');
        });

        $data = [
            'slot' => $this->message,
        ];
        return $this->markdown('emails.feedback')->subject($this->subject)->with($data);
    }
}
