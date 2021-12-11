<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
    }
    
    /**
     * Profile page for student
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, $user_id = false)
    {
        if($user_id) $user = User::findOrFail($user_id);
        else $user = Auth::user();

        if($request->isMethod('post')) {
            // Save new data about user
            if($request->input('type') === 'save_profile'){
                $user = User::saveUser($user, $request);
            }
            return;
        }

        $this->data['user'] = $user;
        $this->data['title'] = 'Profile';
        return view('account.profile', $this->data);
    }
}
