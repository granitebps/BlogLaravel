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
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name..." required value="{{$errors->isEmpty() ? '' : old('category_name')}}">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Create</button>
                </form>
                <hr>
                <a href="{{ route('category.index') }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
@endsection