<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use App\User;
use App\Team;
use App\Course;
use App\CourseExp;
use App\CourseLecture;
use App\UserCourse;
use App\UserLecture;
use App\Faq;
use App\Contact;

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
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
    }
    
    /**
     * Public page for view course
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($course_id)
    {
        $course = Course::findOrFail($course_id);
        $this->data['description'] = $course['description'];

        $course['description'] = CommonService::replaceNlToBr($course['description']);
        $course['description_for_1'] = CommonService::replaceNlToBr($course['description_for_1']);
        $course['description_for_2'] = CommonService::replaceNlToBr($course['description_for_2']);

        $this->data['video_reviews'] = [];
        $this->data['team_one'] = Team::getById($course->team_id, true);
        $lecture_list = CourseLecture::getListByCourse($course_id);
        foreach($lecture_list as $key => $row){
            $lecture_list[$key]['info_short'] = CommonService::replaceNlToBr($row['info_short']);
        }
        $this->data['course_exp_list'] = CourseExp::getListByCourse($course_id);
        $this->data['faq_list'] = Faq::getListByCourse($course_id);

        $this->data['course'] = $course;
        $this->data['lecture_list'] = $lecture_list;
        
        $this->data['title'] = $course['name'];
        return view('course.view', $this->data);
    }

    /**
     * Show lecture list for student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_account($user_id = false)
    {
        if(!$user_id) $user = Auth::user();
        else $user = User::findOrFail($user_id);

        $this->data['courses_all'] = Course::getList();
        $this->data['courses_bonuse'] = Course::getBonuseCourses();
        $this->data['courses_free'] = Course::getFreeCourses();
        $this->data['courses_paid'] = Course::getPaidCourse();
        $this->data['courses_account'] = Course::getListByAccount($user, true);
        
        $this->data['courses_completed'] = $user->courses()->where('date_of_completed', '<=', date('Y-m-d H:i:s'))->get()->keyBy('id')->toArray();

        $this->data['user_id'] = $user_id;
        $this->data['title'] = 'Your Courses';
        return view('course.list_account', $this->data);
    }

    /**
     * Page with one lecture for study student
     *
     * @param int
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lecture($course_id, $lecure_id = false, $user_id = false, Request $request)
    {
        if(!$user_id) $user = Auth::user();
        else $user = User::findOrFail($user_id);

        $course = Course::findOrFail($course_id);
        $this->data['lectures'] = CourseLecture::getListByCourseUser($course, $user);
        
        $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->orderBy('date_of_begin', 'desc')->first();
        $days_data = Course::getLastDays($course, $course_user);
        
        if(!$course_user || $days_data['days_last'] === 0) {
            if($course->free || $course->free_for_client) {
                $course_user = new UserCourse;
                $course_user->user_id = $user->id;
                $course_user->course_id = $course_id;
                $course_user->date_of_begin = date('Y-m-d H:i:s');
                $course_user->save();
            } else {
                return redirect()->route('payment.pay', [$course_id, $user->id]);
            }
        }

        $this->data['lecture_this'] = CourseLecture::getByCourseUserOrId($course, $user, $lecure_id);

        if($request->isMethod('post')){
            // Save new data about team
            if($request->input('type') === 'lecture_finish'){
                $user_id = $user->id;
                if($request->input('lecture_id') === null) return ['data' => $request->all(), 'mess' => 'Unfound Lecture`s ID'];
                if($request->input('user_id') !== null) $user_id = $request->input('user_id');
                
                CourseLecture::completed($request->input('lecture_id'), $user_id);

                $completed = $user->lectures()->where('course_id', $course->id)->get()->count();
                $last = CourseLecture::where('course_id', $course_id)->count() - $completed;
                
                if($last === 0){
                    $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->orderBy('date_of_begin', 'desc')->first();
                    $course_user->date_of_completed = date('Y-m-d H:i:s');
                    $course_user->save();
                }
                
                return ['data' => ['current_completed' => $completed, 'last' => $last], 'mess' => $request->all()];
            }
            return;
        }

        $this->data['team_one'] = Team::find($course->team_id);
        
        $this->data['lectures_completed'] = $user->lectures()->where('course_id', $course->id)->get()->keyBy('id');

        $this->data['user'] = $user;
        $this->data['course_user'] = $course_user;
        $this->data['course_id'] = $course_id;
        $this->data['user_id'] = $user_id;
        $this->data['title'] = ($this->data['lecture_this'] ? $this->data['lecture_this']->name . '' : 'No lecture');
        return view('course.lecture', $this->data);
    }

    /**
     * Show course list for Admin Panel
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_admin($sort_type = 'default')
    {
        $this->data['courses_all'] = Course::getList();
        $this->data['courses_bonuse'] = [];
        $this->data['courses_free'] = [];
        $this->data['courses_paid'] = [];

        $this->data['courses_all'] = Course::getList();

        if($sort_type === 'all' || $sort_type === 'bonuse')
            $this->data['courses_bonuse'] = Course::getBonuseCourses();
        if($sort_type === 'all' || $sort_type === 'free')
            $this->data['courses_free'] = Course::getFreeCourses();
        if($sort_type === 'all' || $sort_type === 'paid')
            $this->data['courses_paid'] = Course::getPaidCourse();

        $this->data['sort_type'] = $sort_type;
        // $this->data['sort_type'] = 'hide';

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
        if(!$course_id) $course = new Course;
        else $course = Course::findOrFail($course_id);

        if($request->isMethod('post')){
            // Save new data about team
            if($request->input('type') === 'save_course'){
                $course = Course::saveOrCreateCourse($course, $request);
                if($request->input('course_faq') !== null) $course_faq = Faq::refreshForCourse($course->id, $request->input('course_faq'));
                if($request->input('course_exp') !== null) $course_exp = CourseExp::refreshForCourse($course->id, $request->input('course_exp'));
                if($request->input('course_lecture') !== null) $course_lecture = CourseLecture::refreshForCourse($course->id, $request->input('course_lecture'));
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
        $this->data['lecture_list'] = CourseLecture::getListByCourse($course_id);
        $this->data['course_exp_list'] = CourseExp::getListByCourse($course_id);
        $this->data['faq_list'] = Faq::getListByCourse($course_id);

        $this->data['course'] = $course;
        $this->data['title'] = 'Edit Course by ID for Admin';
        return view('course.edit', $this->data);
    }

    /**
     * Get sertificate
     * 
     * @param int
     * @param int|False
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get_sertificate($course_id, $user_id = false)
    {
        if(!$user_id) $user = Auth::user();
        else $user = User::findOrFail($user_id);

        $course = Course::findOrFail($course_id);
        
        CommonService::generateSertificate($user);
    }
}
