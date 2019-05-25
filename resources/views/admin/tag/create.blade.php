@extends('layouts.admin')

@section('content')
    <h1 class="page-heading">Tag</h1>
    <div class="row">
        <div class="panel panel-red">
            <div class="panel-heading">Create Tag</div>
            <div class="panel-body">
                <form action="{{route('tag.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input type="text" name="tag_name" class="form-control" required value="{{$errors->isEmpty() ? '' : old('tag_name')}}">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Create</button>
                </form>
                <hr>
                <a href="{{ route('tag.index') }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
@endsection