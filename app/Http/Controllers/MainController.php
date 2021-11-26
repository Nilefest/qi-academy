<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $static_data = CommonService::getStaticData(['team']);
        $this->data = array_merge($this->data, $static_data);
        
        return view('main', $this->data);
    }

    /**
     * Redirect to home page for ayth-users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $this->middleware('auth');

        // For admin
        if(Auth::user()->access == -1) return redirect()->route('admin.dashboard');

        // For client
        if(Auth::user()->access >= 0) return redirect()->route('account.profile');

        return redirect()->route('login');
    }
}
