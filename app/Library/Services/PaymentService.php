<?php
namespace App\Library\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class PaymentService {
    private static $market_data = [
        'hashMethod' => 'sha256',

        'merchantId' => "",
        'serviceId' => "a2630657-3888-4438-9a1c-07a67ca6584d",
        'serviceKey' => "",

        'url_form' => 'https://paywall.imoje.pl/payment',

        'visibleMethod' => 'card,pbl',
        'currency' => 'PLN',
    ];
    
    private static $market_data_test = [
        'merchantId' => "u0lie3x11cj38br2key9",                  // "Identyfikator klienta" = "merchantId" 
        'serviceId' => "c46c3fc8-f1a4-40dd-ac4e-f8dd07673a6a",   // "Identyfikator sklepu" = "serviceId"
        'serviceKey' => "0khmqR87uT92turIuDPR3lvGGZNkfUpZPdvs",  // "Klucz sklepu" = "serviceKey"

        'url_form' => 'https://sandbox.paywall.imoje.pl/payment',
    ];

    public static function getFields($user, $course) {
        $market_links = [
            'urlSuccess' => route('payment.success'),
            'urlFailure' => route('payment.fail'),
            'urlReturn' => route('payment.return'),
        ];
        $market_data = array_merge($market_links, self::$market_data, self::$market_data_test);

        $payment_data = [
            "amount" => $course->cost * 1,
            "orderDescription" => htmlentities('Course ' . $course->name . '. For ' . $user->name . '. ' . date('Y-m-y H-i-s')),
            "orderId" => $user->id . $course->id . time() . rand(100, 999),
        ];

        $client_data = [
            "simp" => $user->id,
            "customerFirstName" => htmlentities($user->name),
            "customerLastName" => htmlentities($user->lastname),
            "customerEmail" => $user->email . '',
            "customerPhone" => $user->phone . ''
        ];

        /* --- FORM data --- */
        $fields = [
            'urlSuccess' => $market_data['urlSuccess'],
            'urlFailure' => $market_data['urlFailure'],
            'urlReturn' => $market_data['urlReturn'],

            'merchantId' => $market_data['merchantId'], // *
            'serviceId' => $market_data['serviceId'],   // *
            
            'visibleMethod' => $market_data['visibleMethod'],
            'currency' =>  $market_data['currency'],    // *

            'amount' => $payment_data['amount'],        // *
            'orderDescription' =>  $payment_data['orderDescription'],    
            'orderId' => $payment_data['orderId'],      // *

            'simp' => $client_data['simp'],
            'customerFirstName' => $client_data['customerFirstName'],// *
            'customerLastName' => $client_data['customerLastName'],  // *
            'customerEmail' => $client_data['customerEmail'],        // *
            'customerPhone' => $client_data['customerPhone'],
        ];

        /* --- SIGNATURE generator --- */
        $signature = self::createSignature($fields, $market_data['serviceKey'], $market_data['hashMethod']);
        $signature_str = $signature . ';' . $market_data['hashMethod'];

        $fields['url_form'] = $market_data['url_form'];
        $fields['signature_str'] = $signature_str;

        return $fields;
    }

    private static function createSignature($orderData, $serviceKey, $hashMethod) {
        $data = self::prepareData($orderData);

        return hash($hashMethod, $data . $serviceKey);
    }
    
    private static function prepareData($data, $prefix = '') {
        ksort($data);
        $hashData = [];
        foreach($data as $key => $value) {
        if($prefix) $key = $prefix . '[' . $key . ']';

        if(is_array($value))$hashData[] = self::prepareData($value, $key);
        else $hashData[] = $key . '=' . $value;
        }
        return implode('&', $hashData);
    }
}