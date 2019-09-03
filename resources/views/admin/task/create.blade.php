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
                        <button type="submit" class="btn btn-success btn-block">Create</button>
                    </form>
                    <hr>
                    <a href="{{ route('task.index') }}" class="btn btn-warning btn-block">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection