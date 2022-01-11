<?php
  
namespace App\Http\Controllers\Auth\Socialite;
  
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Http\Request;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle(\Illuminate\Http\Request $request)
    {
        if($request->input('target_url') !== null) session()->flash('url.intended.custom', $request->input('target_url'));
        else session()->flash('url.intended.custom', redirect()->intended('/home')->getTargetUrl());
        
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('email', $google_user->email)->first();
     
            if($user){
                if($user->google_id === null){
                    $user->google_id = $google_user->id;
                    $user->save();
                }
     
            }else{
                $user = User::create([
                    'name' => $google_user->user['given_name'],
                    'lastname' => $google_user->user['family_name'],
                    'email' => $google_user->email,
                    'google_id'=> $google_user->id,
                    'avatar'=> $google_user->avatar,
                    'email_verified_at'=> ($google_user->user['email_verified'] ? date('Y-m-d H:i:s') : null),
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