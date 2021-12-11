<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;
use Auth;
use App\UserCourse;
use App\UserLecture;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $list_roles = [
        'root' => -1,
        'admin' => 0,
        'client' => 1,
    ];

    public static function saveUser($user, Request $request){
        if($request->input('name') !== null) $user->name = $request->input('name');
        if($request->input('phone') !== null) $user->phone = $request->input('phone');
        if($request->input('email') !== null && !$user->hasVerifiedEmail()) $user->email = $request->input('email');
        if(isset($_FILES['avatar'])){
            $user->avatar = CommonService::uploadFile('profile', $_FILES['avatar'], $user->avatar);
        }
        $user->save();
        return $user;
    }

    public static function getListClients($order_by = false){
        if($order_by) $list = self::where('access', 0)->orderBy($order_by)->get();
        else $list = self::where('access', 0)->get();
        // $list = self::all();

        $list->toArray();

        foreach($list as $key => $item){
            $list[$key]['total_courses'] = UserCourse::where('user_id', $item->id)->count();
        }

        return $list;
    }
    
    public static function checkRole($role_type = 'client'){
        if(Auth::check() && Auth::user()->access === self::$list_roles[$role_type]) return true;
        return false;
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'user_courses');
    }

    public function lectures()
    {
        return $this->belongsToMany('App\CourseLecture', 'user_lectures')->withPivot('date_of_completed');
    }
}
