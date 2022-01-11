<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\CourseOffline;
use App\Contact;

class CourseOfflineController extends Controller
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
     * Show offline course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_admin(Request $request)
    {
        $this->middleware('auth');

        if($request->isMethod('post')){
            // Save new data about course offline
            if($request->input('type') === 'save_course_offline'){
                $course_offline = new CourseOffline;
                if($request->input('id') !== null && $request->input('id') !== '') $course_offline = CourseOffline::findOrFail($request->input('id'));
                
                $course_offline->name = $request->input('name') . '';
                $course_offline->place = $request->input('place') . '';
                $course_offline->date_of = date('Y-m-d H:i:s');
                if($request->input('date_of') !== null) $course_offline->date_of = $request->input('date_of') . '';
                $course_offline->period = $request->input('period') * 1;
                if(!$course_offline->period) $course_offline->period = 1;
                $course_offline->video = $request->input('video') . '';

                $course_offline->save();
                return ['data' => ['id' => $course_offline->id], 'mess' => ''];
            }
            // Save new data about course offline
            if($request->input('type') === 'delete_course_offline'){
                if($request->input('id') === null && $request->input('id') === '') return ['data' => ['id' => 0], 'message' => 'Invalid temmate`s name'];
                
                $course_offline = CourseOffline::findOrFail($request->input('id'));
                $course_offline->delete();
                
                return ['data' => ['id' => $course_offline->id], 'mess' => ''];
            }
            return;
        }


        $courses_offline_list = CourseOffline::getList();
        foreach($courses_offline_list as $key => $course_one) $courses_offline_list[$key]['date_of'] = substr($courses_offline_list[$key]['date_of'], 0, 10);
        $this->data['courses_offline_list'] = $courses_offline_list;

        $this->data['title'] = 'Offline courses for Admin';
        return view('course.offline.list_admin', $this->data);
    }
}
