@extends('layouts.admin')

@section('content')
    <h1 class="page-heading">
        Category
    </h1>
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">Create Category</div>
            <div class="panel-body">
                <form action="{{route('category.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection