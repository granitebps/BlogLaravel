@extends('layouts.admin')

@section('content')
    <h1 class="page-heading">
        Category
    </h1>
    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">Edit Category : {{$category->category_name}}</div>
            <div class="panel-body">
                <form action="{{route('category.update', ['id'=>$category->category_id])}}" method="post">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="{{$errors->isEmpty() ? $category->category_name : old('category_name')}}" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Edit</button>
                </form>
                <hr>
                <a href="{{ route('category.index') }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
@endsection