<?php
namespace App\Library\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

use App\User;

class CommonService {

    /**
     * Get ststic data from JSON files
     * 
     * @param array    - type of data
     * @return array 
     */
    public static function getStaticData($types = []){
        $common_types = ['contacts', 'social'];

        $static_data = Storage::disk('local')->get('static_data.json');
        $static_data = json_decode($static_data, true);

        $output = [];
        foreach(array_merge($types, $common_types) as $type){
            if(isset($static_data[$type])){
                $output[$type] = $static_data[$type];
            }
        }

        return $output;
    }

    /**
     * Get array with row`s key from array`s column
     * 
     * @param array     - start array
     * @param string    - column`s name for get data
     * @return array    - finish array
     */
    public static function colToKey($collection = [], $key){
        $new_arr = [];
        foreach($collection as $row) $new_arr[$row[$key]] = $row;
        return $new_arr;
    }
}