<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\User;

class AccountController extends Controller
{
    /**
     * Profile page for student
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, $user_id = false)
    {
        $this->middleware('auth');
        if($user_id) $user = User::findOrFail($user_id);
        else $user = Auth::user();

        if($request->isMethod('post')){
            // Save new data about user
            if($request->input('type') === 'save_profile'){
                if($request->input('name') !== null) $user->name = $request->input('name');
                if($request->input('phone') !== null) $user->phone = $request->input('phone');
                if($request->input('email') !== null && !$user->hasVerifiedEmail()) $user->email = $request->input('email');
                $user->save();
            }
            return;
        }

        $this->data['user'] = $user;
        $this->data['title'] = 'Profile';
        return view('account.profile', $this->data);
    }
}
