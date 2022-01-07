<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function getFields() {
        $result = self::all();
        $fields = [];
        foreach($result as $row)
            $fields[$row['type']][$row['name']] = $row['value'];
        
        return $fields;
    }

    public static function saveField($type, $name, $value) {
        $result = self::where('type', $type)->where('name', $name)->update(['value' => $value]);
        return $result;
    }

    public static function getByType($type) {
        $result = self::where('type', $type)->get()->keyBy('name');
        return $result;
    }
}
