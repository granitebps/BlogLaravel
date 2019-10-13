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
        $data['tag'] = TagModel::all();
        return view('admin.tag.index')->with($data);
    }

    // Menampilkan halaman edit tag
    public function edit($id)
    {
        $data['title'] = 'Edit Tag';
        $data['tag'] = TagModel::findOrFail($id);
        return view('admin.tag.edit')->with($data);
    }

    // Proses edit tag
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tag_name' => 'required'
        ]);
        $tag = TagModel::findOrFail($id);
        $tag_slug = str_slug($request->tag_name);
        $tag->update([
            'tag_name' => $request->tag_name,
            'tag_slug' => $tag_slug
        ]);

        notify()->success('Tag Updated');
        return redirect()->route('tag.index');
    }

    // Proses hapus tag
    public function destroy($id)
    {
        $tag = TagModel::findOrFail($id);
        $tag->delete();

        notify()->success('Tag Deleted');
        return redirect()->route('tag.index');
    }
}
