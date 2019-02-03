<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailModel;

class SubscriberController extends Controller
{
    // Menampilkan Subscriber
    public function index()
    {
        $data['subs'] = EmailModel::get_subs();
        return view('admin.subs.index', $data);
    }
}
