<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\User;
use App\Models\TaskModel;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Menampilkan halaman user
    public function index()
    {
        $data['task'] = TaskModel::get_task();
        $data['user'] = User::get_user();
        $data['setting'] = SettingModel::get_setting();
        return view('admin.user.user', $data);
    }

    // Menghapus user / memindahkan user ke trash
    public function destroy($id)
    {
        User::delete_user($id);
        Session::flash('error', 'User Trashed');
        return redirect()->route('user');
    }

    // Menampilkan user yang di trashed
    public function trashed()
    {
        $data['task'] = TaskModel::get_task();
        $data['setting'] = SettingModel::get_setting();
        $data['user'] = User::get_trashed();
        return view('admin.user.trashed', $data);
    }

    // Memulihkan user
    public function restore($id)
    {
        User::restore($id);
        Session::flash('success', 'User Restored');
        return redirect()->route('user');
    }

    // Menghapus user permanen
    public function kill($id)
    {
        User::kill($id);
        Session::flash('error', 'User Permanently Deleted');
        return redirect()->route('user.trashed');
    }
}
