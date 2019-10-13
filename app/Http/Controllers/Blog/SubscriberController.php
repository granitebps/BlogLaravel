<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\EmailModel;

class SubscriberController extends Controller
{
    // Menampilkan Subscriber
    public function index()
    {
        $data['title'] = 'Subscriber List';
        $data['subs'] = EmailModel::all();
        return view('admin.subs.index')->with($data);
    }

    // Menghapus subscriber
    public function destroy($id)
    {
        $subs = EmailModel::find($id);
        $subs->delete();

        notify()->success('Subscriber Deleted');
        return redirect()->route('subs.index');
    }
}
