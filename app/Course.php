<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;

class Course extends Model
{
    public static function getList()
    {
        $list = self::orderBy('name')->get();
        return $list;
    }

    public static function saveOrCreateCourse($course, Request $request)
    {
        $course->free = $request->input('free') . '';
        $course->free_for_client = $request->input('free_for_client') . '';
        $course->only_paid = $request->input('only_paid') . '';
        $course->name = $request->input('name') . '';
        $course->total_lectures = $request->input('total_lectures') . '';
        $course->total_hours = $request->input('total_hours') . '';
        $course->cost = $request->input('cost') . '';
        $course->video_preview = $request->input('video_preview') . '';
        $course->description = $request->input('description') . '';
        $course->description_for_1 = $request->input('description_for_1') . '';
        $course->description_for_2 = $request->input('description_for_2') . '';
        $course->team_id = $request->input('team_id') . '';
        if(isset($_FILES['banner_img'])) $course->banner_img = CommonService::uploadFile('courses', $_FILES['banner_img'], $course->img);
        if(isset($_FILES['gallery_img_1'])) $course->gallery_img_1 = CommonService::uploadFile('courses', $_FILES['gallery_img_1'], $course->img);
        if(isset($_FILES['gallery_img_2'])) $course->gallery_img_2 = CommonService::uploadFile('courses', $_FILES['gallery_img_2'], $course->img);
        if(isset($_FILES['gallery_img_3'])) $course->gallery_img_3 = CommonService::uploadFile('courses', $_FILES['gallery_img_3'], $course->img);
        $course->save();

        return $course;
    }
    
    public static function deleteById($team_id)
    {
        $team = self::find($team_id);
        $team->delete();

        return $team->id;
    }
}
