<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\CourseOffline;

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
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['courses_offline_list'] = CourseOffline::getList();
        
        $this->data['video_reviews'] = CommonService::getDataFromFile('default_review.json');
        
        $this->data['team_list'] = Team::getList(true);

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
