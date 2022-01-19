<?php
namespace App\Library\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Mail\SubscribesMail;
use App\Mail\SendReviewMail;

class MailService {
    
    public static function sendMessage($to_email, $subject = '', $message = []){
        Mail::to($to_email)->send(new FeedbackMail($subject, $message));
    }

    public static function sendSubscribeArticle($user, $subject = '', $message = []){
        Mail::to($user['email'])->send(new SubscribesMail($user, $subject, $message));
    }

    public static function sendVideoReview($user, $course, $review_text = '', $file = false){
        Mail::to('nikitaleo777333@gmail.com')->send(new SendReviewMail($user, $course, $review_text, $file));
    }
}
