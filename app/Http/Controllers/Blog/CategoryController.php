<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\CategoryModel;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    // Menampilkan list category
    public function index()
    {
        $data['title'] = 'Category List';
        $data['category'] = CategoryModel::all();
        return view('admin.category.index')->with($data);
    }

    // Menampilkan halaman membuat category
    public function create()
    {
        $data['title'] = 'Create Category';
        return view('admin.category.create')->with($data);
    }

    // Proses membuat category
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|string|max:191'
        ]);

        CategoryModel::create([
            'category_name' => $request->category_name,
            'category_slug' => str_slug($request->category_name),
        ]);

        notify()->success('Category Created');
        return redirect()->route('category.index');
    }

    // Menampilkan halaman edit category
    public function edit($id)
    {
        $data['title'] = 'Edit Category';
        $data['category'] = CategoryModel::findOrFail($id);
        return view('admin.category.edit')->with($data);
    }

    // Proses edit category
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required|string|max:191'
        ]);
        $category = CategoryModel::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => str_slug($request->category_name),
        ]);

        notify()->success('Category Updated');
        return redirect()->route('category.index');
    }

    // Menghapus category
    public function destroy($id)
    {
        $category = CategoryModel::findOrFail($id);
        foreach ($category->post as $row) {
            $post = PostModel::where('category_id', $id)->first();
            $post->tags()->detach();
            File::delete($row->featured);
            $row->forceDelete();
        }
        $category->delete();
        notify()->success('Category Deleted');
        return redirect()->route('category.index');
    }
}
