<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\EmailModel;
use Illuminate\Support\Facades\Session;

class SubscriberController extends Controller
{
    // Menampilkan Subscriber
    public function index()
    {
        $data['title'] = 'Subscriber List';
        $data['subs'] = EmailModel::get_subs();
        return view('admin.subs.index')->with($data);
    }

    // Menghapus subscriber
    public function destroy($id)
    {
        EmailModel::delete_subs($id);

        Session::flash('error', 'Subscriber Deleted');
        return redirect()->route('subs.index');
    }
}
