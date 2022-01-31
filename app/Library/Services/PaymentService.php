<?php
namespace App\Library\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Setting;
use App\Payment;

class PaymentService {

    /** Correct and formated field for payment-form
     * 
     * @param User user who pay
     * @param Course for pay
     * @return string with all fields of payment-form
     */
    public static function getFields($user, $course) {
        $setting = Setting::getByType('imoje');
        if($setting['test_mode']['value'] === '1') $test_mode = '_TEST';
        else $test_mode = '';

        $market_data = [
            'hashMethod' => 'sha256',

            'merchantId' => env('IMOJE_MERCHANT_ID' . $test_mode),
            'serviceId' => env('IMOJE_SERVICE_ID' . $test_mode),
            'serviceKey' => env('IMOJE_SERVICE_KEY' . $test_mode),

            'url_form' => env('IMOJE_ACTION' . $test_mode),

            'visibleMethod' => 'card,pbl',
            'currency' => 'PLN',
            
            'urlSuccess' => route('payment.success'),
            'urlFailure' => route('payment.fail'),
            'urlReturn' => route('payment.return'),
        ];

        $payment_data = [
            "amount" => $course->cost * 100,
            "orderDescription" => htmlentities('Course ' . $course->name . '. For ' . $user['name'] . '. ' . date('Y-m-y')),
            "orderId" => $user['id'] . $course->id . strtotime(date('Y-m-d')),
        ];

        $client_data = [
            "simp" => $user['id'],
            "customerFirstName" => htmlentities($user['name']),
            "customerLastName" => htmlentities($user['lastname']),
            "customerEmail" => $user['email'] . '',
            "customerPhone" => $user['phone'] . ''
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
            'orderDescription' =>  self::translit_text($payment_data['orderDescription']),    
            'orderId' => $payment_data['orderId'],      // *

            'validTo' => strtotime(date('Y-m-d') . ' + 1 days'),

            'simp' => $client_data['simp'],
            'customerFirstName' => self::translit_text($client_data['customerFirstName']),// *
            'customerLastName' => self::translit_text($client_data['customerLastName']),  // *
            'customerEmail' => self::translit_text($client_data['customerEmail']),        // *
            'customerPhone' => self::translit_text($client_data['customerPhone']),
        ];

        /* --- SIGNATURE generator --- */
        $signature = self::createSignature($fields, $market_data['serviceKey'], $market_data['hashMethod']);
        $signature_str = $signature . ';' . $market_data['hashMethod'];

        $fields['url_form'] = $market_data['url_form'];
        $fields['signature_str'] = $signature_str;

        Payment::createOrUpdate($user['id'], $course['id'], $signature, $fields);

        return $fields;
    }

    /** Get hash-signature for payment-service
     * 
     * @param array order data
     * @param string service key
     * @param string method for hash
     * @return string signature
     */
    private static function createSignature($orderData, $serviceKey, $hashMethod) {
        $data = self::prepareData($orderData);

        return hash($hashMethod, $data . $serviceKey);
    }
    
    /** Get string-data for convert to hash-signature
     * 
     * @param array data
     * @param string data-prefix
     * @return string with data
     */
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

    /** Translit text for correct-format text-data
     * 
     * @param string input text
     * @return string converted text
     */
    private static function translit_text($text) {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        );
        
        $text = str_replace(array(' ', ','), '-', $text);
        $text = strtr($text, $converter);
        $text = mb_ereg_replace('[-]+', '-', $text);
        $text = trim($text, '-');

        return $text;
    }
}
