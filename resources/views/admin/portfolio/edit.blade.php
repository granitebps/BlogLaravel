@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1 class="page-heading">Portfolio</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Edit Portfolio</div>
            <div class="panel-body">
                <form action="{{route('portfolio.update', ['id'=>$portfolio->portfolio_id])}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="form-group">
                        <label>Image</label><br>
                        <img src="{{asset('storage/images/portfolio/'.$portfolio->portfolio_image)}}" alt="" width="240px" height="160px">
                        <input type="file" name="portfolio_image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Portfolio Name</label>
                        <input type="text" name="portfolio_name" class="form-control" required value="{{$errors->isEmpty() ? $portfolio->portfolio_name : old('portfolio_name')}}">
                    </div>
                    <div class="form-group">
                        <label>Portfolio Description</label>
                        <textarea name="portfolio_desc" id='article-ckeditor' cols="30" rows="10">{{$errors->isEmpty() ? $portfolio->portfolio_desc : old('portfolio_desc')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Portfolio Link</label>
                        <input type="text" name="portfolio_url" class="form-control" required value="{{$errors->isEmpty() ? $portfolio->portfolio_url : old('portfolio_url')}}">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Edit</button>
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