<?php
namespace App\Library\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class MailService {
    
    public static function sendMessage($to_email, $subject = '', $message = []){
        Mail::to($to_email)->send(new ClientMail($subject, $message));
    }
}
