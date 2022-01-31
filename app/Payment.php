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
        $payment = self::where('order_id', $fields['orderId'])->first();
        if(!$payment) $payment = new Payment;
            
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

    /** Set response by signature
     * 
     * @param string Signature for payment
     * @param array response data if has
     * @return Payment object from DB
     */
    public static function setResponse($signature, $response = []) {
        $payment = self::where('signature', $signature)->first();
        $payment->response = json_encode($response);
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
