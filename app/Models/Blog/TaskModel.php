<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'task';
    protected $fillable = ['task', 'deadline', 'completed'];
}
