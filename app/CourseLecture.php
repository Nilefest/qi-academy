<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Services\CommonService;

class CourseLecture extends Model
{
    public static function getListByCourse($course_id = false)
    {
        if(!$course_id) return [];
        $list = self::where('course_id', $course_id)->get();
        return $list;
    }

    public static function getByCourseOrId($course, $lecture_id = false){
        if($lecture_id) return self::findOrFail($lecture_id);
        return self::where('course_id', $course->id)->first();
    }

    public static function getListByCourseUser($course, $user)
    {
        $list = self::where('course_id', $course->id)->get()->toArray();
        $completed = $user->lectures()->where('course_id', $course->id)->get()->keyBy('course_id');
        foreach($list as $key => $row){
            $list[$key]['date_of_completed'] = '';
            if(isset($completed[$row['id']])) $list[$key]['date_of_completed'] = $completed[$row['id']]['date_of_completed'];
        }
        return $list;
    }
    
    public static function refreshForCourse($course_id, $lecture_list = [])
    {
        self::where('course_id', $course_id)->delete();
        foreach($lecture_list as $key => $lecture_item){
            $new_item = new self;
            $new_item->course_id = $course_id;
            $new_item->name = $lecture_item['name'] . '';
            $new_item->info_short = $lecture_item['info_short'] . '';
            $new_item->info_full = $lecture_item['info_full'] . '';
            $new_item->video = $lecture_item['video'] . '';
            $new_item->homework = $lecture_item['homework'] . '';
            if(isset($_FILES['course_lecture']['name'][0]['file'])){
                $new_item->file = CommonService::uploadFile('lectures', $_FILES['course_lecture'], $new_item->file, $key, 'file');
            }
            $new_item->save();
            $lecture_list[$key] = $new_item;
        }
        return $lecture_list;
    }
}
