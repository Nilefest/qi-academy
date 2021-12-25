<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Services\CommonService;
use App\Library\Services\PaymentService;
use App\User;
use App\Course;
use App\UserCourse;
use App\UserLecture;

class PaymentController extends Controller
{
    
    /**
     * Page for pay
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay($course_id, $user_id = false)
    {
        if($user_id) $user = User::findOrFail($user_id);
        elseif(Auth::check()) $user = Auth::user();
        else return redirect()->route('courses.lecture', $course_id);

        $course = Course::findOrFail($course_id);
        $this->data['user'] = $user;

        $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
        if($course_user) {
            return redirect()->route('courses.lecture', $course_id);
        }
        
        $fields = PaymentService::getFields($user, $course);
        $this->data['fields'] = $fields;
        
        $this->data['course'] = $course;
        $this->data['user'] = $user;
        $this->data['title'] = 'Pay course';
        return view('payment.pay', $this->data);
    }

    public function success($course_id, $user_id = false, Request $request)
    {
        $user = false;
        if($user_id) $user = User::find($user_id);
        elseif(Auth::check()) $user = Auth::user();

        $course = Course::findOrFail($course_id);

        if($user && $course){
            $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
            if(!$course_user) {
                $course_user = new UserCourse;
                $course_user->user_id = $user->id;
                $course_user->course_id = $course_id;
                $course_user->date_of_begin = date('Y-m-d H:i:s');
                $course_user->save();
            }
            return redirect()->route('courses.lecture', $course_id);
        }

        echo 'SUCCESS: ';
        print_r($request->all());
        exit();
    }
    public function fail(Request $request)
    {
        echo 'SUCCESS: ';
        print_r($request->all());
        exit();
    }
    public function return(Request $request)
    {
        echo 'SUCCESS: ';
        print_r($request->all());
        exit();
    }
}
