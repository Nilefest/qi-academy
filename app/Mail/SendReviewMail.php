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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $course, $text_review = "", $file = false)
    {
        $this->subject = 'Video review by student';
        $this->message = (new MailMessage)->subject($this->subject);
        
        $this->message->line('Student ' . $user['name'] . ' ' . $user['lastname'] . '(' . $user['email'] . ')' . ' finish course:');
        $this->message->action($course['name'], route('course.view', $course['id']));
        
        $this->message->line('And last review:');
        $this->message->line('' . $text_review);
        $this->message->line('[' . date('Y-m-d H:i:s') . ']');
        
        if($file) {
            $this->attach($file['tmp_name'], [
                'as' => $file['name'],
                'mime' => $file['type'],
            ]);
        }
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
