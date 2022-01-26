<?php
namespace App\Library\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Mail\SubscribesMail;
use App\Mail\SendReviewMail;
use App\Contact;

class MailService {

    /** Send mail with custom message
     * 
     * @param string email address recipient
     * @param string message subject
     * @param array message data
     * @return void
     */
    public static function sendMessage($to_email, $subject = '', $message = []){
        Mail::to($to_email)->send(new FeedbackMail($subject, $message));
    }

    /** Send mail for subscriber
     * 
     * @param User subscriber-recipient
     * @param string message subject
     * @param array message data
     * @return void
     */
    public static function sendSubscribeArticle($user, $subject = '', $message = []){
        Mail::to($user['email'])->send(new SubscribesMail($user, $subject, $message));
    }

    /** Send mail with video-review
     * 
     * @param User author review
     * @param Course about this review
     * @param string text review
     * @param array video-file
     * @return void
     */
    public static function sendVideoReview($user, $course, $review_text = '', $file = false){
        $emails = Contact::getByType('emails');

        Mail::to($emails['video_review']['link'])->send(new SendReviewMail($user, $course, $review_text, $file));
    }
}
