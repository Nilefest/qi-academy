<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOffline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses_offline';
    
    public static function getList()
    {
        $list = self::orderBy('place')->orderBy('date_of')->orderBy('name')->get();
        return $list;
    }
}
