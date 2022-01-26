<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Course;
use App\CourseOffline;
use App\Review;
use App\Contact;

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
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
        $this->data['emails'] = Contact::getByType('emails');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data = array_merge($this->data, CommonService::getDataFromFile('main.default.json'));

        $this->data['main_course'] = Course::getMainCourse();
        $this->data['paid_courses'] = Course::getPaidCourse();
        $this->data['courses_offline_list'] = CourseOffline::getList(true);

        $this->data['main_educations'] = CommonService::getDataFromFile('main_educations.default.json');
        $this->data['video_reviews'] = Review::all();
        $this->data['team_list'] = Team::getList(true, 3, true);
        
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
