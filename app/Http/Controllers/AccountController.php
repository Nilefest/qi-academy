<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\CommonService;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserCourse;
use App\Contact;
use App\Course;
>>>>>>> dev

class AccountController extends Controller
{
    /**
<<<<<<< HEAD
=======
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
>>>>>>> dev
     * Profile page for student
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function profile()
    {
        $this->middleware('auth');

=======
    public function profile(Request $request, $user_id = false)
    {
        if($user_id) $user = User::findOrFail($user_id);
        else $user = Auth::user();
        
        if($request->isMethod('post')) {
            // Save new data about user
            if($request->input('type') === 'save_profile'){
                $user = User::saveUser($user, $request);
            }
            elseif(Auth::user()->checkRole('admin')){
                // Add course for user
                if($request->input('type') === 'add_profile_course'){
                    if($request->input('course_id') === null) return ['mess' => [], 'data' => []];

                    $course = Course::findOrFail($request->input('course_id'));

                    $user_course = UserCourse::where('user_id', $user->id)->where('course_id', $course->id)->where('date_of_end', '>=', date('Y-m-d'))->first();
                    if($user_course === null) {
                        $user_course = new UserCourse();
                        $user_course->user_id = $user->id;
                        $user_course->course_id = $course->id;
                        $user_course->date_of_begin = date('Y-m-d H:i:s');
                        
                        $user_course_info = Course::getLastDays($course, $user_course);
                    } else {
                        $user_course_info = Course::getLastDays($course, $user_course, true);
                    }

                    $user_course->date_of_end = $user_course_info['date_of_end'];
                    $user_course->save();

                    $user_course_info['user_course_id'] = $user_course['id'];
                    $user_course_info['name'] = $course['name'];
                    return ['mess' => [], 'data' => $user_course_info];
                }
                elseif($request->input('type') === 'delete_profile_course'){
                    if($request->input('user_course_id') === null) return ['mess' => 'Fail!', 'data' => []];

                    UserCourse::where('id', $request->input('user_course_id'))->delete();

                    return ['mess' => 'Deleted!', 'data' => []];
                }
                
                // Delete new data about user
                if($request->input('type') === 'delete_profile'){
                    $user = User::deleteUser($user);
                }
            }
            return;
        }

        $this->data['courses'] = Course::all();
        $this->data['profile_courses'] = Course::getListByAccount($user);

        $this->data['user'] = $user;
        $this->data['user_id'] = $user_id;
>>>>>>> dev
        $this->data['title'] = 'Profile';
        return view('account.profile', $this->data);
    }
}
