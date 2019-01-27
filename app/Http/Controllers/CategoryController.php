<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\TaskModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    // Menampilkan list category
    public function index()
    {
        $data['category'] = CategoryModel::get_category();
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        return view('admin.category.index', $data);
    }

    // Menampilkan halaman membuat category
    public function create()
    {
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        return view('admin.category.create', $data);
    }

    // Proses membuat category
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $request = $request->all();
        CategoryModel::create_category($request);
        Session::flash('success', 'Category Created');
        return redirect()->route('category.index');
    }

    // Menampilkan halaman edit category
    public function edit($id)
    {
        $data['category'] = CategoryModel::get_category_id($id);
        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        return view('admin.category.edit', $data);
    }

    // Proses edit category
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);
        $request = $request->all();
        CategoryModel::update_category($request, $id);
        Session::flash('success', 'Category Updated');
        return redirect()->route('category.index');
    }

    // Menghapus category
    public function destroy($id)
    {
        CategoryModel::delete_category($id);
        Session::flash('error', 'Category Deleted');
        return redirect()->route('category.index');
    }
}
