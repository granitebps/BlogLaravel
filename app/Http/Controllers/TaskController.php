<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskModel;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    // Menampilkan task
    public function index()
    {
        return view('admin.task.index');
    }

    // Menampilkan halaman membuat task
    public function create()
    {
        return view('admin.task.create');
    }

    // Proses membuat task
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
            'deadline' => 'required'
        ]);

        $request = $request->all();
        TaskModel::create_task($request);
        Session::flash('success', 'Task Created');
        return redirect()->route('task.index');
    }

    // Menampilkan halaman edit task
    public function edit($id)
    {
        $data['task_id'] = TaskModel::get_task_id($id);
        return view('admin.task.edit', $data);
    }

    // Proses edit task
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'task' => 'required',
            'deadline' => 'required'
        ]);

        $request = $request->all();
        TaskModel::update_task($request, $id);
        Session::flash('success', 'Task Updated');
        return redirect()->route('task.index');
    }

    // Menghapus task
    public function destroy($id)
    {
        TaskModel::delete_task($id);
        Session::flash('error', 'Task Deleted');
        return redirect()->route('task.index');
    }

    // Membuat task menjadi completed
    public function completed($id)
    {
        TaskModel::completed($id);
        Session::flash('success', 'Task Completed');
        return redirect()->route('task.index');
    }
}
