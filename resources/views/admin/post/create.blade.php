@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1 class="page-heading">Post</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Create Post</div>
            <div class="panel-body">
                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Featured Image</label>
                        <input type="file" name="featured" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="post_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Post Content</label>
                        <textarea name="post_content" id='article-ckeditor' cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $row)
                                <option value="{{$row->category_id}}">{{$row->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        @foreach ($tag as $row)
                        <div class="checkbox-inline">
                            <input type="checkbox" name="tag[]" value="{{$row->tag_id}}">{{$row->tag_name}}
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Publish</button>
                </form>
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