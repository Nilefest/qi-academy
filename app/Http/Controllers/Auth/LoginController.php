<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Contact;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // echo redirect()->back()->getTargetUrl(); exit();
        // if(!session()->has('from')){
        //     session()->put('from', url()->previous());
        // }
        $this->data['emails'] = Contact::getByType('emails');

        $this->data['title'] = 'Sign in';
        return view('auth.login', $this->data);
    }

    public function authenticated($request, $user)
    {
        if($user->access === 2){
            $user->access = 1;
            $user->save();
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
