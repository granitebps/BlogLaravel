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
                    <form action="{{route('tag.update', ['id'=>$tag->tag_id])}}" method="post">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="form-group">
                            <label>Tag Name</label>
                            <input type="text" name="tag_name" class="form-control" value="{{$errors->isEmpty() ? $tag->tag_name : old('tag_name')}}" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Edit</button>
                    </form>
                    <hr>
                    <a href="{{ route('tag.index') }}" class="btn btn-warning btn-block">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection