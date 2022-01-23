<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Services\CommonService;
use App\UserLecture;

class CourseLecture extends Model
{
    public static function getListByCourse($course_id = false)
    {
        if(!$course_id) return [];
        $list = self::where('course_id', $course_id)->get();
        return $list;
    }

    public static function getByCourseUserOrId($course, $user, $lecture_id = false){
        if($lecture_id) return self::findOrFail($lecture_id);
        $completed = $user->lectures()->where('course_id', $course->id)->get()->keyBy('id')->toArray();
        $list = self::where('course_id', $course->id)->get();
        
        $current = $list->first(function($value) use ($completed) {
            return !isset($completed[$value['id']]);
        });
        if(!$current) $current = $list[0];
        
        return $current;
    }

    public static function getListByCourseUser($course, $user)
    {
        $list = self::where('course_id', $course->id)->get()->toArray();
        $completed = $user->lectures()->where('course_id', $course->id)->get()->keyBy('id');
        foreach($list as $key => $row){
            $list[$key]['date_of_completed'] = '';
            if(isset($completed[$row['id']])) $list[$key]['date_of_completed'] = $completed[$row['id']]['pivot']['date_of_completed'];
        }
        
        return $list;
    }
    
    public static function refreshForCourse($course_id, $lecture_list = [])
    {
        $old = self::where('course_id', $course_id)->get()->keyBy('id');

        foreach($lecture_list as $key => $lecture_item){
            if(isset($old[$lecture_item['id']])){
                $new_item = $old[$lecture_item['id']];
                unset($old[$lecture_item['id']]);
            } else {
                $new_item = new self;
                $new_item->course_id = $course_id;
                $new_item->file = '';
            }
            $new_item->name = $lecture_item['name'] . '';
            $new_item->info_short = $lecture_item['info_short'] . '';
            $new_item->info_full = $lecture_item['info_full'] . '';
            $new_item->video = $lecture_item['video'] . '';
            $new_item->homework = $lecture_item['homework'] . '';
            if($lecture_item['file_status'] === '#deleted') {
                CommonService::deleteFile( $new_item->file);
                $new_item->file = '';
            }
            
            if(isset($_FILES['course_lecture']['name'][$key]['file'])){
                $new_item->file = CommonService::uploadFile('lectures', $_FILES['course_lecture'], $new_item->file, $key, 'file');
            }
            $new_item->save();
            $lecture_list[$key] = $new_item;
        }
        foreach($old as $key => $old_one) $old_one->delete();
        
        return $lecture_list;
    }
    
    public static function completed($lecture_id, $user_id)
    {
        $user_lecture = UserLecture::where('user_id', $user_id)->where('course_lecture_id', $lecture_id)->orderBy('created_at', 'desc')->first();
        if(!$user_lecture){
            $user_lecture = new UserLecture;
            $user_lecture->course_lecture_id = $lecture_id;
            $user_lecture->user_id = $user_id;
        }
        $user_lecture->date_of_completed = date('Y-m-d H:i:s');
        $user_lecture->save();
        
        return $user_lecture->id;
    }
}
