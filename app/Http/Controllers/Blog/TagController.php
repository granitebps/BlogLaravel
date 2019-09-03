<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\TagModel;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    // Menampilkan halaman tag
    public function index()
    {
        $data['title'] = 'Tag List';
        $data['tag'] = TagModel::get_tag();
        return view('admin.tag.index')->with($data);
    }

    // Menampilkan halaman membuat tag | Tag dibuat otomatis saat membuat post
    public function create()
    {
        abort(404);
        // return view('admin.tag.create');
    }

    // Proses membuat tag | Tag dibuat otomatis saat membuat post
    public function store(Request $request)
    {
        abort(404);
        // $this->validate($request, [
        //     'tag_name' => 'required'
        // ]);
        // $request = $request->all();
        // TagModel::create_tag($request);
        // Session::flash('success', 'Tag Created');
        // return redirect()->route('tag.index');
    }

    // Menampilkan halaman edit tag
    public function edit($id)
    {
        $data['title'] = 'Edit Tag';
        $data['tag'] = TagModel::get_tag_id($id);
        return view('admin.tag.edit')->with($data);
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
