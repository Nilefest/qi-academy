<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;

class TestController extends Controller
{
    public function get(){
        return 'Test GET';
    }
    
    public function post(){
        return 'Test POST';
    }
}
