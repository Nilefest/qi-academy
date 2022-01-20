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
        else {
            try{ 
                session()->flash('url.intended.custom', redirect()->intended('/home')->getTargetUrl());
            }
            catch(Exception $e){
                return redirect()->refresh();
            }
        }
        
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
                if(!$user->email_verified_at){
                    $user->email_verified_at =  date('Y-m-d H:i:s');
                    $user->save();
                }
     
            }else{
                $names = explode(' ', $facebook_user['name']);
                $user = User::create([
                    'name' => $names[0],
                    'lastname' => (isset($names[1]) ? $names[1] : $facebook_user['name']),
                    'email' => $facebook_user['email'],
                    'facebook_id'=> $facebook_user->getId(),
                    'password' => time() . rand(100, 999),
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
            }
            
            Auth::login($user);
            return redirect(session('url.intended.custom'));
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect('/');
        }
    }
}