<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Services\CommonService;
use Illuminate\Http\Request;

class Contact extends Model
{
    public static function getByType($type = false){
        if(!$type) return self::all();

        $data = self::where('type', $type)->get();
        $data = CommonService::colToKey($data, 'title');
        return $data;
    }

    public static function saveByType($type, $data = []){
        foreach($data as $title => $value){
            $item = self::where('type', $type)->where('title', $title)->update(['link' => $value]);
        }
    }
}
