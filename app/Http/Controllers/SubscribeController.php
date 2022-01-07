<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Services\CommonService;
use App\User;

class SubscribeController extends Controller
{
    public function add(Request $request){
        $email = $request->input('email');
        if($email !== null) {
            $users = User::where('email', $email)->get();
            if(!$users) User::where('email', $email)->update(['subscribe' => 1]);
            else {
                $user = new User;
                $user->name = 'your name';
                $user->lastname = 'your lastname';
                $user->email = $email;
                $user->password = time() . rand(100, 999);
                $user->access = 2;
                $user->save();
            }
        }
    }
    
    public function delete(Request $request, $email = false){
        if(!$email) $email = $request->input('email');
        if($email === null && Auth::check()) $email = Auth::user()->email;
        
        if($email !== null) User::where('email', $email)->update(['subscribe' => 0]);
    }
}
