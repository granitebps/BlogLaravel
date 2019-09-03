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
    </div>
</div>
@endsection