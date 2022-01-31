<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Library\Services\CommonService;

use App\Library\Services\MailService;
use Illuminate\Notifications\Messages\MailMessage;

use App\Payment;

class TestController extends Controller
{
    public function get(){


        exit('dsaf');
    }
    
    public function post(){
        return 'Test POST';
    }
}
