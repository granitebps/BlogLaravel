<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Hash;

class ProfileModel extends Model
{
    protected $table = 'profile';
    protected $guarded = ['created_at', 'deleted_at'];

    // Relasi One to One dengan User
    public function user()
    {
        return $this->belongsTo('App\Models\Blog\User');
    }

    // Untuk mengambil data user sesuai dengan id yang sedang login
    public static function get_user_login()
    {
        return User::where('id', Auth::id())->first();
    }

    // Proses update avatar user
    public static function update_avatar($avatar_name)
    {
        $user = self::get_user_login();
        $user->profile->avatar = 'images/avatars/' . $avatar_name;
        $user->profile->save();
    }

    // Proses update user
    public static function update_user($request)
    {
        $user = self::get_user_login();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->profile->address = $request['address'];
        $user->profile->user_about = $request['user_about'];
        $user->profile->contact_email = $request['contact_email'];
        $user->profile->contact_number = $request['contact_number'];
        $user->profile->instagram = $request['instagram'];
        $user->profile->facebook = $request['facebook'];
        $user->profile->twitter = $request['twitter'];
        $user->profile->linkedin = $request['linkedin'];
        $user->profile->github = $request['github'];
        $user->save();
        $user->profile->save();
    }

    // Proses ganti password
    public static function update_password($request)
    {
        $user = self::get_user_login();
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $confirm_password = $request['confirm_password'];
        if (Hash::check($old_password, $user->password)) {
            if ($confirm_password == $new_password) {
                $user->password = Hash::make($new_password);
                $user->save();
                return 'success';
            } else {
                return 'error_confirm';
            }
        } else {
            return 'error_old';
        }
    }

    // Mengambil data profile
    public static function get_profile()
    {
        return User::first();
    }
}
