<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    /** Create or Update payment data by order-id
     * 
     * @param integer Customer-User ID
     * @param integer Course ID for order
     * @param string Signature for payment
     * @param array payment data
     * @param array response data if has
     * @return Payment object from DB
     */
    public static function createOrUpdate($user_id, $course_id, $signature, $fields = [], $response = []){
        $payment = self::getPaymentByOrderId($fields['orderId']);
        
        if(!$payment || $payment->user_course_id) $payment = new Payment;
        $payment->signature = $signature;

        $payment->customer_name = $fields['customerFirstName'] . '';
        $payment->customer_lastname = $fields['customerLastName'] . '';
        $payment->customer_email = $fields['customerEmail'] . '';
        if(isset($fields['customerPhone'])) $payment->customer_phone = $fields['customerPhone'] . '';
            
        $payment->order_id = $fields['orderId'];
        $payment->amount = $fields['amount'];
        $payment->order_description = $fields['orderDescription'] . '';
        
        $payment->user_id = $user_id;
        $payment->course_id = $course_id;
        $payment->response = json_encode($response);

        $payment->save();

        return $payment;
    }

    /** Get Payment by Order ID
     * 
     * @param string Order Id
     * @return Payment|null
     */
    public static function getPaymentByOrderId($order_id) {
        $payment = self::where('order_id', $order_id)->orderBy('created_at', 'desc')->first();
        return $payment;
    }

    /** Set response by Order Id
     * 
     * @param string Order ID for payment
     * @param array response data if has
     * @return Payment object from DB
     */
    public static function setResponseByOrderId($order_id, $response = []) {
        $payment = self::getPaymentByOrderId($order_id);
        $payment->response = json_encode($response);
        $payment->save();

        return $payment;
    }

    /** Set new pay status for payment by Order Id
     * 
     * @param string Order ID for payment
     * @param int Pay status
     * @return Payment object from DB
     */
    public static function setPayStatusByOrderId($order_id, $pay_status = '') {
        $payment = self::getPaymentByOrderId($order_id);
        $payment->pay_status = $pay_status;
        $payment->save();

        return $payment;
    }

    /** Set Paid User-Course Id by Order Id
     * 
     * @param string Order ID for payment
     * @param int User-Course ID
     * @return Payment object from DB
     */
    public static function setUserCourseIdByOrderId($order_id, $user_course_id) {
        $payment = self::getPaymentByOrderId($order_id);
        $payment->user_course_id = $user_course_id;
        $payment->save();

        return $payment;
    }

    /** Delete old and without response paymets 
     * 
     * @return void
    */
    public static function deleteEmptyOld() {
        self::where('response', json_encode([]))->where('created_at', '<', date('Y-m-d', strtotime('-1 months')))->delete();
    }
}
