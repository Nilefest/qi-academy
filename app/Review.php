<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public static function getList($limit = -1)
    {
        $list = self::limit($limit)->get();
        return $list;
    }
}
