<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User as Users;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function follwing()
    {
        return $this->belongsToMany(Users::class,'followers','follower_id','following_id');
    }


    public function amIfollowing($user_id)
    {
        return \DB::table('followers')->where('follower_id',auth()->user()->id)->where('following_id',$user_id)->exists();
    }

    public static function follwingIds()
    {
        return \DB::table('followers')->select('following_id')->where('follower_id',auth()->user()->id)->get();
    }
}
