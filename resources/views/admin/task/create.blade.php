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
                    <form action="{{route('task.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Task</label>
                            <input name="task" type="text" class="form-control" required value="{{$errors->isEmpty() ? '' : old('task')}}">
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" name="deadline" class="form-control" required value="{{$errors->isEmpty() ? '' : old('deadline')}}">
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection