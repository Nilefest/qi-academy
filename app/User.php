<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Library\Services\CommonService;

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
}