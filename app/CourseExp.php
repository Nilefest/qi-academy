<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseExp extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_exp';
    
    public static function getListByCourse($course_id = false)
    {
        if(!$course_id) return [];
        $list = self::where('course_id', $course_id)->orderBy('info')->get();
        return $list;
    }
    
    public static function refreshForCourse($course_id, $exp_list = [])
    {
        self::where('course_id', $course_id)->delete();
        foreach($exp_list as $key => $exp_item){
            $new_item = new self;
            $new_item->course_id = $course_id;
            $new_item->info = $exp_item['info'];
            $new_item->save();
            $exp_list[$key] = $new_item;
        }
        return $exp_list;
    }
}
