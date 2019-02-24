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
        $data['subs'] = EmailModel::get_subs();
        return view('admin.subs.index', $data);
    }
}
