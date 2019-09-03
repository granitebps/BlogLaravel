<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Menampilkan halaman user
    public function index()
    {
        $data['title'] = 'Users List';
        $data['user'] = User::get_user();
        return view('admin.user.user')->with($data);
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
        $data['title'] = 'Trashed User';
        $data['user'] = User::get_trashed();
        return view('admin.user.trashed')->with($data);
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
