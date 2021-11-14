<?php
namespace App\Library\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

use App\User;

class CommonService {

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