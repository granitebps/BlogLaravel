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
                    <form action="{{route('portfolio.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Image | You can select multiple file</label>
                            <input type="file" name="portfolio_image[]" class="form-control-file" multiple>
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