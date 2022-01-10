<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Library\Services\CommonService;

use App\Library\Services\MailService;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;

class TestController extends Controller
{
    public function get(){
        // $message = [
        //     ['type' => 'line', 'value' => 'It is for you'],
        //     ['type' => 'line', 'value' => 'It is too'],
        //     ['type' => 'subject', 'value' => 'second subject'],
        //     ['type' => 'action', 'value' => 'Test button', 'attribute' => 'https://www.google.com/'],
        //     ['type' => 'line', 'value' => 'Last line'],
        // ];
        // MailService::sendSubscribeArticle(User::all()[0], 'Subs mail', $message);

        MailService::sendVideoReview(User::all()[0], '');
    }
    
    public function post(){
        return 'Test POST';
    }
}
