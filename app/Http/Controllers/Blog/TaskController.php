<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\TaskModel;

class TaskController extends Controller
{
    // Menampilkan task
    public function index()
    {
        $data['task'] = TaskModel::orderBy('created_at', 'desc')->get();
        $data['title'] = 'Task List';
        return view('admin.task.index')->with($data);
    }

    // Menampilkan halaman membuat task
    public function create()
    {
        $data['title'] = 'Create Task';
        return view('admin.task.create')->with($data);
    }

    // Proses membuat task
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|string|max:191',
            'deadline' => 'required|date'
        ]);

        TaskModel::create([
            'task' => $request->task,
            'deadline' => $request->deadline
        ]);

        notify()->success('Task Created');
        return redirect()->route('task.index');
    }

    // Menampilkan halaman edit task
    public function edit($id)
    {
        $data['title'] = 'Edit Task';
        $data['task_id'] = TaskModel::findOrFail($id);
        return view('admin.task.edit')->with($data);
    }

    // Proses edit task
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'task' => 'required|string|max:191',
            'deadline' => 'required|date'
        ]);

        $task = TaskModel::findOrFail($id);
        $task->update([
            'task' => $request->task,
            'deadline' => $request->deadline
        ]);

        notify()->success('Task Updated');
        return redirect()->route('task.index');
    }

    // Menghapus task
    public function destroy($id)
    {
        $task = TaskModel::findOrFail($id);
        $task->delete();

        notify()->success('Task Deleted');
        return redirect()->route('task.index');
    }

    // Membuat task menjadi completed
    public function completed($id)
    {
        $task = TaskModel::findOrFail($id);
        $task->update([
            'completed' => 1
        ]);

        notify()->success('Task Completed');
        return redirect()->route('task.index');
    }
}
