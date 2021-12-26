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
        'name', 'lastname', 'access', 'email', 'password', 'google_id', 'facebook_id'
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
        'subscribe' => 2,
    ];

    public static function saveUser($user, Request $request){
        if($request->input('name') !== null) $user->name = $request->input('name');
        if($request->input('lastname') !== null) $user->lastname = $request->input('lastname');
        if($request->input('phone') !== null) $user->phone = $request->input('phone');
        if($request->input('email') !== null && !$user->hasVerifiedEmail()) $user->email = $request->input('email');
        if(isset($_FILES['avatar'])){
            $user->avatar = CommonService::uploadFile('profile', $_FILES['avatar'], $user->avatar);
        }
        if($user->access === 2) $user->access = 1;
        $user->save();
        return $user;
    }

    public static function getListByType($type = false, $order_by = false, $search_by = false){
        if(!$order_by) $order_by = 'name';
        
        if(isset(self::$list_roles[$type])) $result = self::where('access', self::$list_roles[$type]);
        else $result = self::where('access', 'like', '%');

        if($search_by){
            $result = $result->where(function($query) use ($search_by) {
                $query->where('name', 'like', "%$search_by%")->orWhere('lastname', 'like', "%$search_by%")->orWhere('phone', 'like', "%$search_by%")->orWhere('email', 'like', "%$search_by%");
            });
        }

        if(in_array($order_by, ['name', 'lastname', 'phone', 'email'])) $list = $result->orderBy($order_by)->get();
        else $list = $result->get();
        
        // Get total courses for clients
        foreach($list as $key => $item){
            $list[$key]['total_courses'] = UserCourse::where('user_id', $item['id'])->count();
        }

        // Special sort
        if($order_by === 'total_courses') $list = $list->sortByDesc('total_courses')->values();

        // print_r($list->toArray()); exit();
        return $list->toArray();
    }
    
    public static function checkRole($role_type = 'client'){
        if(Auth::check() && isset(self::$list_roles[$role_type])){
            $user_access = Auth::user()->access;
            $role_access = self::$list_roles[$role_type];
            
            if($user_access === $role_access) return true;
            if($user_access < 0 && $role_access === 0) return true; // For root
            if($user_access === 2 && $role_access === 1) return true; // For subscribe as client
        }
        return false;
    }
    
    public static function getTotalWithCourses() {
        $total = UserCourse::all()->groupBy('user_id')->count();
        return $total;
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
