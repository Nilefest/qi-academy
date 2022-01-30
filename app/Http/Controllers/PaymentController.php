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
use File;

class PaymentController extends Controller
{
    
    /** Page for pay
     *
     * @param int Course ID
     * @param int User ID
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay($course_id, $user_id = false, Request $request) {
        if($user_id) $user = User::findOrFail($user_id);
        elseif(Auth::check()) $user = Auth::user();
        else return redirect()->route('courses.lecture', $course_id);

        $course = Course::findOrFail($course_id);
        $this->data['user'] = $user;

        $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
        $days_data = Course::getLastDays($course, $course_user);
        if($course_user && $days_data['days_last'] > 0) {
            return redirect()->route('courses.lecture', $course_id);
        }

        if($request->input('update_signature') !== null){
            $user = $user->toArray();
            if($request->input('customerFirstName') !== null) $user['name'] = $request->input('customerFirstName'); 
            if($request->input('customerLastName') !== null) $user['lastname'] = $request->input('customerLastName'); 
            if($request->input('customerEmail') !== null) $user['email'] = $request->input('customerEmail'); 
            if($request->input('customerPhone') !== null) $user['phone'] = $request->input('customerPhone');
        }
        
        $fields = PaymentService::getFields($user, $course);
        $this->data['fields'] = $fields;
        
        if($request->isMethod('post') && $request->input('update_signature') !== null){
            $data = [
                'customerFirstName' => $fields['customerFirstName'], 
                'customerLastName' => $fields['customerLastName'], 
                'customerEmail' => $fields['customerEmail'], 
                'customerPhone' => $fields['customerPhone'], 
                'orderDescription' => $fields['orderDescription'],
                'signature_str' => $fields['signature_str']
            ];
            return ['status' => 'success', 'data' => $data, 'mess' => 'Success!'];
        }
        
        $this->data['course'] = $course;
        $this->data['user'] = $user;
        $this->data['title'] = 'Pay course';
        return view('payment.pay', $this->data);
    }

    /** Result after payment as SUCCESS
     * 
     * @param int Course ID
     * @param int User ID
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function success($course_id, $user_id = false, Request $request) {
        $user = false;
        if($user_id) $user = User::find($user_id);
        elseif(Auth::check()) $user = Auth::user();


        // Verif

        $course = Course::findOrFail($course_id);

        if($user && $course){
            $course_user = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
            $days_data = Course::getLastDays($course, $course_user);

            if(!$course_user || $days_data['days_last'] === 0) {
                $course_user = new UserCourse;
                $course_user->user_id = $user->id;
                $course_user->course_id = $course_id;
                $course_user->date_of_begin = date('Y-m-d H:i:s');
                //$course_user->save();
            }
            return redirect()->route('courses.lecture', $course_id);
        }


        $str_result = date('Y-m-d H:i:s') . " - SUCCESS - \n";

        if($request->input('transaction') !== null){
            $transaction = $request->input('transaction');
            $str_result .= "\t Transaction:\n";
            foreach($transaction as $key => $value) $str_result .= "\t > $key : $value\n";
        }
        
        if($request->input('payment') !== null){
            $transaction = $request->input('payment');
            $str_result .= "\t Payment:\n";
            foreach($payment as $key => $value) $str_result .= "\t > $key : $value\n";
        }

        if($request->input('action') !== null){
            $action = $request->input('action');
            $str_result .= "\t Action:\n";
            foreach($action as $key => $value) $str_result .= "\t > $key : $value\n";
        }

        $str_result .= "\n";

        File::append(public_path('/payment.txt'), $str_result);

        echo 'SUCCESS: ';
        print_r($request->all());
        exit();
    }

    /** Result after payment as FAIL
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fail(Request $request) {
        
        $str_result = date('Y-m-d H:i:s') . " - FAIL - \n";

        if($request->input('transaction') !== null){
            $transaction = $request->input('transaction');
            $str_result .= "\t Transaction:\n";
            foreach($transaction as $key => $value) $str_result .= "\t > $key : $value\n";
        }
        
        if($request->input('payment') !== null){
            $transaction = $request->input('payment');
            $str_result .= "\t Payment:\n";
            foreach($payment as $key => $value) $str_result .= "\t > $key : $value\n";
        }

        if($request->input('action') !== null){
            $action = $request->input('action');
            $str_result .= "\t Action:\n";
            foreach($action as $key => $value) $str_result .= "\t > $key : $value\n";
        }

        $str_result .= "\n";

        File::append('/payment.txt', $str_result);

        echo 'FAIL: ';
        print_r($request->all());
        exit();
    }

    /** Result after payment with answer
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function return(Request $request) {
        echo 'SUCCESS: ';
        print_r($request->all());
        exit();
    }
}
