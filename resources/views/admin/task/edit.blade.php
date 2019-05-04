@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Task</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    Task List
                </div>
                <div class="panel-body">
                    <form action="{{route('task.update', ['id'=> $task_id->id])}}" method="post">
                        @method('put')
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Task</label>
                            <input name="task" type="text" value="{{$errors->isEmpty() ? $task_id->task : old('task')}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" name="deadline" class="form-control" required value="{{$errors->isEmpty() ? $task_id->deadline : old('deadline')}}">
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection