<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Services\CommonService;
use App\Library\Services\PaymentService;
use App\Contact;
use App\User;
use App\Course;
use App\UserCourse;
use App\UserLecture;
use App\Payment;
use File;

class PaymentController extends Controller
{
    /** Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->data = array_merge($this->data, CommonService::getDataFromFile());
        $this->data['contacts'] = Contact::getByType('contacts');
        $this->data['social'] = Contact::getByType('social');
        $this->data['emails'] = Contact::getByType('emails');
    }
    
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

        $user_course = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
        $days_data = Course::getLastDays($course, $user_course);
        if($user_course && $days_data['days_last'] > 0) {
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
     * @param int|false Order ID for Payment
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function success($order_id = false, Request $request) {
    
        $payment = Payment::getPaymentByOrderId($order_id);
        if(!$payment) return redirect()->route('main');
        
        $user = User::find($payment['user_id']);
        $course = Course::find($payment['course_id']);
        
        // Verif
        // ...
        if($payment['pay_status'] === 'settled' && !$payment['user_course_id']){

            if($user && $course){
                $user_course = UserCourse::where('user_id', $user->id)->where('course_id', $course->id)->first();
                $days_data = Course::getLastDays($course, $user_course);
    
                if(!$user_course || $days_data['days_last'] === 0) {
                    $user_course = new UserCourse;
                    $user_course->user_id = $user->id;
                    $user_course->course_id = $course->id;
                    $user_course->date_of_begin = date('Y-m-d H:i:s');
                    $user_course->save();
                    
                    Payment::setUserCourseIdByOrderId($order_id, $user_course->id);
                }
                return redirect()->route('courses.lecture', $course->id);
            }
        }
        return redirect()->route('courses.lecture', $course->id);

        // $user = false;
        // if($user_id) $user = User::find($user_id);
        // elseif(Auth::check()) $user = Auth::user();

        // Verif
        // $signature = $request->input('');
        // Payment::setResponse($signature, $request->all());

        // $course = Course::findOrFail($course_id);

        // if($user && $course){
        //     $user_course = UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->first();
        //     $days_data = Course::getLastDays($course, $user_course);

        //     if(!$user_course || $days_data['days_last'] === 0) {
        //         $user_course = new UserCourse;
        //         $user_course->user_id = $user->id;
        //         $user_course->course_id = $course_id;
        //         $user_course->date_of_begin = date('Y-m-d H:i:s');
        //         // $user_course->save();
        //     }
        //     // return redirect()->route('courses.lecture', $course_id);
        // }


        // $str_result = date('Y-m-d H:i:s') . " - SUCCESS - \n";

        // if($request->input('transaction') !== null){
        //     $transaction = $request->input('transaction');
        //     $str_result .= "\t Transaction:\n";
        //     foreach($transaction as $key => $value) $str_result .= "\t > $key : $value\n";
        // }
        
        // if($request->input('payment') !== null){
        //     $transaction = $request->input('payment');
        //     $str_result .= "\t Payment:\n";
        //     foreach($payment as $key => $value) $str_result .= "\t > $key : $value\n";
        // }

        // if($request->input('action') !== null){
        //     $action = $request->input('action');
        //     $str_result .= "\t Action:\n";
        //     foreach($action as $key => $value) $str_result .= "\t > $key : $value\n";
        // }

        // $str_result .= "\n";

        // File::append(public_path('/payment.txt'), $str_result);

        // echo 'SUCCESS: ';
        // print_r($request->all());
        exit('*');
    }

    /** Result after payment as FAIL
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fail($order_id = false, Request $request) {
        $str_result = date('Y-m-d H:i:s') . " - FAIL - \n";

        if($request->input('transaction') !== null){
            $transaction = $request->input('transaction');
            $str_result .= "\t Transaction:\n";
            foreach($transaction as $key => $value) $str_result .= "\t > $key : $value\n";
        }
        
        // if($request->input('payment') !== null){
        //     $transaction = $request->input('payment');
        //     $str_result .= "\t Payment:\n";
        //     foreach($payment as $key => $value) $str_result .= "\t > $key : $value\n";
        // }

        // if($request->input('action') !== null){
        //     $action = $request->input('action');
        //     $str_result .= "\t Action:\n";
        //     foreach($action as $key => $value) $str_result .= "\t > $key : $value\n";
        // }

        $str_result .= "\n";

        File::append(public_path('/payment.txt'), $str_result);

        echo 'FAIL: ';
        print_r($request->all());
        exit();
    }

    /** Result after payment with answer
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function return(Request $request) {
        
        File::put(public_path('/payment.json'), json_encode($request->all()));

        $header_signature = $request->headers->get('X-IMoje-Signature');

        $request_data = $request->all();
        if(isset($request_data['transaction'])){
            $transaction = $request_data['transaction'];
            
            Payment::setResponseByOrderId($transaction['orderId'], $transaction);
            Payment::setPayStatusByOrderId($transaction['orderId'], $transaction['status']);

        }



        $str_result = date('Y-m-d H:i:s') . " - RETURN - \n";

        if($request->input('transaction') !== null){
            $transaction = $request->input('transaction');
            $str_result .= "\t Transaction:\n";
            foreach($transaction as $key => $value) $str_result .= "\t > $key : $value\n";
        }
        
        if($request->input('payment') !== null){
            $payment = $request->input('payment');
            $str_result .= "\t Payment:\n";
            foreach($payment as $key => $value) $str_result .= "\t > $key : $value\n";
        }

        // if($request->input('action') !== null){
        //     $action = $request->input('action');
        //     $str_result .= "\t Action:\n";
        //     foreach($action as $key => $value) $str_result .= "\t > $key : $value\n";
        // }

        // $str_result .= "\n";

        // File::append(public_path('/payment.txt'), $str_result);
        // File::append(public_path('/payment.txt'), "\n" . $header_signature);

        $response_data = ['status' => 'ok'];

        return response()->json($response_data);
    }
}
