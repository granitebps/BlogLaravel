<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan tampilan edit profile
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = User::first();
        return view('admin.profile.profile')->with($data);
    }

    // Proses update profile
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'email' => 'required|email',
            'avatar' => 'image|max:2048',
            'address' => 'required',
            'user_about' => 'required',
            'contact_number' => 'required|string|max:191',
            'instagram' => 'required|url|max:191',
            'facebook' => 'required|url|max:191',
            'twitter' => 'required|url|max:191',
            'linkedin' => 'required|url|max:191',
        ]);

        $user = User::first();
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatar_name = time() . $avatar->getClientOriginalName();
            Storage::putFileAs('public/images/avatar', $avatar, $avatar_name);
            $user->profile->avatar = $avatar_name;
            $user->profile->save();
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->profile->address = $request->address;
        $user->profile->user_about = $request->user_about;
        $user->profile->contact_number = $request->contact_number;
        $user->profile->instagram = $request->instagram;
        $user->profile->facebook = $request->facebook;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->github = $request->github;
        $user->save();
        $user->profile->save();

        notify()->success('Profile Updated');
        return redirect()->route('profile');
    }

    // Menampilkan halaman edit password
    public function edit_password()
    {
        $data['title'] = 'Change Password';
        return view('admin.profile.change_password')->with($data);
    }

    // Proses ganti password
    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:8'
        ]);

        $user = User::first();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            notify()->success('Password Changed');
        } else {
            notify()->error('Wrong Old Password');
        }

        return redirect()->route('password');
    }
}
