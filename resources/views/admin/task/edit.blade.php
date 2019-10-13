@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
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
                        <button type="submit" class="btn btn-block btn-success">Edit</button>
                    </form>
                    <hr>
                    <a href="{{ route('task.index') }}" class="btn btn-warning btn-block">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection