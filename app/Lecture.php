<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Services\CommonService;

class Lecture extends Model
{
    public static function getListByCourse($course_id = false)
    {
        if(!$course_id) return [];
        $list = self::where('course_id', $course_id)->get();
        return $list;
    }
    
    // public static function refreshForCourse($course_id, $lecture_list = [])
    // {
    //     self::where('course_id', $course_id)->delete();
    //     foreach($lecture_list as $key => $lecture_item){
    //         $new_item = new self;
    //         $new_item->course_id = $course_id;
    //         $new_item->name = $lecture_item['name'] . '';
    //         $new_item->info_short = $lecture_item['info_short'] . '';
    //         $new_item->info_full = $lecture_item['info_full'] . '';
    //         $new_item->video = $lecture_item['video'] . '';
    //         $new_item->homework = $lecture_item['homework'] . '';
    //         if(isset($_FILES['course_lecture']['name'][0]['file'])){
    //             $new_item->file = CommonService::uploadFile('lectures', $_FILES['course_lecture'], $new_item->file, $key, 'file');
    //         }
    //         $new_item->save();
    //         $lecture_list[$key] = $new_item;
    //     }
    //     return $lecture_list;
    // }
}
