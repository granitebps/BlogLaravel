<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    // Menampilkan tampilan setting
    public function edit()
    {
        return view('admin.setting.setting');
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
