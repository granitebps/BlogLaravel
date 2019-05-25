@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1 class="page-heading">Portfolio</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Create Portfolio</div>
            <div class="panel-body">
                <form action="{{route('portfolio.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="portfolio_image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Portfolio Name</label>
                        <input type="text" name="portfolio_name" class="form-control" required value="{{$errors->isEmpty() ? '' : old('portfolio_name')}}">
                    </div>
                    <div class="form-group">
                        <label>Portfolio Description</label>
                        <textarea name="portfolio_desc" id='article-ckeditor' cols="30" rows="10">{{$errors->isEmpty() ? '' : old('portfolio_desc')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Portfolio Link</label>
                        <input type="text" name="portfolio_url" class="form-control" required value="{{$errors->isEmpty() ? '' : old('portfolio_url')}}">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Create</button>
                </form>
                <hr>
                <a href="{{ route('portfolio.index') }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            height: '500px',
        };
        CKEDITOR.replace( 'article-ckeditor', options);
    </script>
@endsection