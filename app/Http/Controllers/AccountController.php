<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;

class AccountController extends Controller
{
    /**
     * Profile page for student
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $this->middleware('auth');

        $this->data['title'] = 'Profile';
        return view('account.profile', $this->data);
    }
}
