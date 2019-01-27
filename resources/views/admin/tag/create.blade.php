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
                        <input type="text" name="tag_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection