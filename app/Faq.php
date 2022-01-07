<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';
    
    public static function getListByCourse($course_id = false)
    {
        if(!$course_id) return [];
        $list = self::where('course_id', $course_id)->orderBy('title')->get();
        return $list;
    }
    
    public static function refreshForCourse($course_id, $faq_list = [])
    {
        self::where('course_id', $course_id)->delete();
        foreach($faq_list as $key => $faq_item){
            $new_item = new self;
            $new_item->course_id = $course_id;
            $new_item->title = $faq_item['title'] . '';
            $new_item->info = $faq_item['info'] . '';
            $new_item->save();
            $faq_list[$key] = $new_item;
        }
        return $faq_list;
    }
}
