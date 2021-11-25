<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Socialite;
use Exception;
use Auth;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('email', $facebook_user->email)->first();
     
            if($user){
                if($user->facebook_id == null){
                    $user->facebook_id = $facebook_user->getId();
                    $user->save();
                }
                Auth::login($user);
                return redirect(RouteServiceProvider::HOME);
     
            }else{
                $newUser = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id'=> $facebook_user->getId(),
                    'password' => 'newtemprandompassword'
                ]);
                Auth::login($newUser);
                return redirect(RouteServiceProvider::HOME);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}