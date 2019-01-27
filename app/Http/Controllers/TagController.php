<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\TaskModel;
use App\Models\TagModel;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    // Menampilkan halaman tag
    public function index()
    {
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        $data['tag'] = TagModel::get_tag();
        return view('admin.tag.index', $data);
    }

    // Menampilkan halaman membuat tag
    public function create()
    {
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        return view('admin.tag.create', $data);
    }

    // Proses membuat tag
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag_name' => 'required'
        ]);
        $request = $request->all();
        TagModel::create_tag($request);
        Session::flash('success', 'Tag Created');
        return redirect()->route('tag.index');
    }

    // Menampilkan halaman edit tag
    public function edit($id)
    {
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        $data['tag'] = TagModel::get_tag_id($id);
        return view('admin.tag.edit', $data);
    }

    // Proses edit tag
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tag_name' => 'required'
        ]);
        $request = $request->all();
        TagModel::update_tag($request, $id);
        Session::flash('success', 'Tag Updated');
        return redirect()->route('tag.index');
    }

    // Proses hapus tag
    public function destroy($id)
    {
        TagModel::delete_tag($id);
        Session::flash('error', 'Tag Deleted');
        return redirect()->route('tag.index');
    }
}
