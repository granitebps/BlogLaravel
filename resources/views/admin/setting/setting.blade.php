@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Setting</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Edit Site Setting
                </div>
                <div class="panel-body">
                    <form action="{{route('setting.update')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Site Name</label>
                            <input name="site_name" type="text" value="{{$errors->isEmpty() ? $setting->site_name : old('site_name')}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Site About</label>
                            <textarea id="article-ckeditor" name="about" cols="30" rows="10" class="form-control" required>{{$errors->isEmpty() ? $setting->about : old('about')}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </form>
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
            height: '700px',
            extraPlugins: 'codesnippet,iframe',
        };
        CKEDITOR.replace( 'article-ckeditor', options);
    </script>
@endsection