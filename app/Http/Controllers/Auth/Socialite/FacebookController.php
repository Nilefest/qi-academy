<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook(\Illuminate\Http\Request $request)
    {
        if($request->input('target_url') !== null) session()->flash('url.intended.custom', $request->input('target_url'));
        else session()->flash('url.intended.custom', redirect()->intended(RouteServiceProvider::HOME)->getTargetUrl());
        
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
     
            }else{
                $user = User::create([
                    'name' => $facebook_user->getName(),
                    'lastname' => $facebook_user->getLastName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id'=> $facebook_user->getId(),
                    'password' => time() . rand(100, 999)
                ]);
            }
            
            Auth::login($user);
            return redirect(session('url.intended.custom'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}