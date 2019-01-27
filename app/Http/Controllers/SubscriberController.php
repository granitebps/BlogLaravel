<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailModel;
use App\Models\TaskModel;
use App\Models\SettingModel;

class SubscriberController extends Controller
{
    // Menampilkan Subscriber
    public function index()
    {
        $data['task'] = TaskModel::get_task();
        $data['setting'] = SettingModel::get_setting();
        $data['subs'] = EmailModel::get_subs();
        return view('admin.subs.index', $data);
    }
}
