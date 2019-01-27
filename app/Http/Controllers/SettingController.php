<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\TaskModel;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    // Menampilkan tampilan setting
    public function edit()
    {
        $data['task'] = TaskModel::get_task();
        $data['setting'] = SettingModel::get_setting();
        return view('admin.setting.setting', $data);
    }

    // Proses Update Setting
    public function update(Request $request)
    {
        $this->validate($request, [
            'site_name' => 'required',
            'about' => 'required'
        ]);
        $request = $request->all();
        SettingModel::update_setting($request);

        Session::flash('success', 'Site Setting Updated');

        return redirect()->route('setting');
    }
}
