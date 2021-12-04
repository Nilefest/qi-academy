<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\Team;
use App\Course;
use App\CourseExp;
use App\Lecture;
use App\Faq;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
    }
    
    /**
     * Public page for view course
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($course_id)
    {
        $this->data['title'] = 'View course by ID';
        return view('course.view', $this->data);
    }

    /**
     * Show lecture list for student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_account()
    {
        $this->middleware('auth');

        $courses_list = Course::getList();

        $this->data['courses_list'] = $courses_list;
        $this->data['title'] = 'Courses by Account';
        return view('course.list_account', $this->data);
    }

    /**
     * Page with one lecture for study student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lecture($lecure_id)
    {
        $this->middleware('auth');

        $this->data['title'] = 'Lecture by ID';
        return view('course.lecture', $this->data);
    }

    /**
     * Show course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_admin()
    {
        $this->middleware('auth');

        $courses_list = Course::getList();

        $this->data['courses_list'] = $courses_list;
        $this->data['title'] = 'Courses for Admin';
        return view('course.list_admin', $this->data);
    }

    /**
     * Page for Edit Courses. Only for Admin
     * 
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($course_id = false, Request $request)
    {
        $this->middleware('auth');
        if(!$course_id) $course = new Course;
        else $course = Course::findOrFail($course_id);

        if($request->isMethod('post')){
            // Save new data about team
            if($request->input('type') === 'save_course'){ //return ['data' => ['id' =>  $course_id], 'mess' => $_FILES['course_lecture']['name']];
                $course = Course::saveOrCreateCourse($course, $request);
                if($request->input('course_faq') !== null) $course_faq = Faq::refreshForCourse($course->id, $request->input('course_faq'));
                if($request->input('course_exp') !== null) $course_exp = CourseExp::refreshForCourse($course->id, $request->input('course_exp'));
                if($request->input('course_lecture') !== null) $course_lecture = Lecture::refreshForCourse($course->id, $request->input('course_lecture'));
                return ['data' => ['id' => $course->id], 'mess' => ''];
            }
            // Save new data about team
            if($request->input('type') === 'delete_course'){
                if($request->input('id') === null) return ['data' => ['id' => 0], 'message' => 'Nofound ID'];
                $course_id = Course::deleteById($request->input('id'));
                return ['data' => ['id' =>  $course_id], 'mess' => ''];
            }
            return;
        }

        $this->data['team_list'] = Team::getList();
        $this->data['lecture_list'] = Lecture::getListByCourse($course_id);
        $this->data['course_exp_list'] = CourseExp::getListByCourse($course_id);
        $this->data['faq_list'] = Faq::getListByCourse($course_id);

        $this->data['course'] = $course;
        $this->data['title'] = 'Edit Course by ID for Admin';
        return view('course.edit', $this->data);
    }
}
