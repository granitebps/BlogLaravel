<?php

namespace App\Models\Blog;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    // Relasi One to One dengan Profile
    public function profile()
    {
        return $this->hasOne('App\Models\Blog\ProfileModel');
    }

    // Relasi One To Many dengan Post
    public function posts()
    {
        return $this->hasMany('App\Models\Blog\PostModel');
    }
}
