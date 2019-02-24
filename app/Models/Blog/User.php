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

    // Menampilkan semuda data user
    public static function get_user()
    {
        return User::all();
    }

    // Menghapus user / memindahkan user ke trash
    public static function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    // / Menampilkan user hanya yang di trashed
    public static function get_trashed()
    {
        return User::onlyTrashed()->get();
    }

    // Memulihkan user
    public static function restore($id)
    {
        return User::onlyTrashed()->where('id', $id)->restore();
    }

    // Menghapus user permanen
    public static function kill($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        if ($user->profile->avatar != 'images/avatars/default.png') {
            File::delete($user->profile->avatar);
        }
        $user->profile->delete();
        $user->forceDelete();
    }
}
