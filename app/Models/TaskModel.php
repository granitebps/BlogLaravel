<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'task';
    protected $fillable = ['task', 'deadline', 'completed'];

    // Mengambil semua task
    public static function get_task()
    {
        return TaskModel::orderBy('created_at', 'desc')->get();
    }

    // Proses membuat task
    public static function create_task($request)
    {
        $task = $request['task'];
        $deadline = $request['deadline'];
        TaskModel::create([
            'task' => $task,
            'deadline' => $deadline
        ]);
    }

    // Mengambil task berdasarkan id
    public static function get_task_id($id)
    {
        return TaskModel::find($id);
    }

    // Proses update task
    public static function update_task($request, $id)
    {
        $task_id = self::get_task_id($id);
        $task = $request['task'];
        $deadline = $request['deadline'];
        $task_id->update([
            'task' => $task,
            'deadline' => $deadline
        ]);
    }

    // Proses hapus task
    public static function delete_task($id)
    {
        $task = self::get_task_id($id);
        $task->delete();
    }

    // Proses completed task
    public static function completed($id)
    {
        $task = self::get_task_id($id);
        $task->update([
            'completed' => 1
        ]);
    }
}
