<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Auth;
use App\UserCourse;
use App\UserLecture;
use App\CourseLecture;
use DB;

class Course extends Model
{
    public static function getList($limit = -1)
    {
        $list = self::orderBy('name')->limit($limit)->get();
        return $list;
    }

    public static function getFreeCourses($limit = -1)
    {
        $list = self::where('free', 1)->orderBy('name')->limit($limit)->get()->keyBy('id');
        return $list;
    }

    public static function getBonuseCourses($limit = -1)
    {
        $list = self::where('free_for_client', 1)->orderBy('name')->limit($limit)->get()->keyBy('id');
        return $list;
    }

    public static function getListByAccount($user, $only_last = false)
    {
        if($only_last) $list = $user->courses->keyBy('id')->toArray();
        else $list = $user->courses->toArray();
        
        foreach($list as $key => $row){
            $days_data = self::getLastDays($row, $row['pivot']);
            $list[$key]['pivot'] = array_merge($row['pivot'], $days_data);
        }
        return $list;
    }

    public static function getLastDays($course, $user_course, $add_days = false){
        $date_of_start = $user_course['date_of_begin'];
        $date_of_end = $user_course['date_of_end'];
        if($add_days){
            if($date_of_end === null) $date_of_start = date('Y-m-d');
            else $date_of_start = $date_of_end;
        }

        if($add_days || $date_of_end === null) {
            $datetime_of_end = strtotime($date_of_start . ' + ' . $course['total_days'] . ' days');
            $date_of_end = date('Y-m-d', $datetime_of_end);
        } else{
            $datetime_of_end = strtotime($date_of_end);
        }
        
        $days_last = round(($datetime_of_end - time()) / (24*60*60));

        $days_data = [
            'date_of_begin' => $user_course['date_of_begin'],
            'date_of_start' => $date_of_start,
            'date_of_end' => $date_of_end,
            'days_last' => $days_last <= 0 ? 0 : $days_last
        ];
        return $days_data;
    }

    public static function saveOrCreateCourse($course, Request $request)
    {
        $course->free = $request->input('free') . '';
        $course->free_for_client = $request->input('free_for_client') . '';
        $course->only_paid = $request->input('only_paid') . '';
        $course->name = $request->input('name') . '';
        $course->total_days = $request->input('total_days') * 1;
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

        $course->main_course = $request->input('main_course') * 1;
        if($course->main_course){
            $old_main = self::where('main_course', 1)->where('id', '!=', $course->id)->update(['main_course' => 0]);
        }
        $course->save();

        return $course;
    }
    
    public static function deleteById($team_id) {
        $team = self::find($team_id);
        $team->delete();

        return $team->id;
    }

    public static function getMainCourse() {
        $course = self::where('main_course', 1)->first();
        if($course === null) return false;
        return $course;
    }

    public static function getPaidCourse($limit = -1) {
        $courses = self::where('only_paid', 1)->limit($limit)->get()->toArray();
        $lectures_total = CourseLecture::select('course_id', DB::raw('count(*) as total'))->groupBy('course_id')->get()->keyBy('course_id');
        foreach($courses as $key => $course){
            if(isset($lectures_total[$course['id']])) $courses[$key]['total_lectures'] = $lectures_total[$course['id']]['total'];
            else $courses[$key]['total_lectures'] = 0;
        }
        
        return $courses;
    }

    public function LectureTitle($total = 1) {
        if($total === 1) return 'lekcja';
        if($total < 5) return 'lekcje';
        return 'lekcji';
    }

    public function isBy($user_id = false) {
        
        if($user_id) $user = User::findOrFail($user_id)->id;
        elseif(Auth::check())$user_id = Auth::user()->id;
        else return false;

        $course_id = $this->id;

        $course_user = UserCourse::where('user_id', $user_id)->where('course_id', $course_id)->first();
        $days_data = self::getLastDays($this, $course_user);

        if($course_user && $days_data['days_last'] > 0) return true;
        return false;
    }
}
