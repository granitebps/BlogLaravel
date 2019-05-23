@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1 class="page-heading">Post</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Edit Post</div>
            <div class="panel-body">
                <form action="{{route('post.update', ['id'=>$post->post_id])}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Featured Image</label><br>
                        <img src="{{ asset('storage/images/posts/'.$post->featured) }}" style="height:auto; width:20%;">
                        <input type="file" name="featured" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="post_title" class="form-control" value="{{$errors->isEmpty() ? $post->post_title : old('post_title')}}" required>
                    </div>
                    <div class="form-group">
                        <label>Post Content</label>
                        <textarea name="post_content" id='article-ckeditor' cols="30" rows="10">{{$errors->isEmpty() ? $post->post_content: old('post_content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $row)
                                <option value="{{$row->category_id}}"
                                    @if (($errors->isEmpty() && $post->category->category_id == $row->category_id) || (!$errors->isEmpty() && old('category_id') == $row->category_id))
                                        selected
                                    @endif
                                >{{$row->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        @foreach ($tag as $row)
                        <div class="checkbox-inline">
                            <input type="checkbox" name="tag[]" value="{{$row->tag_id}}"
                                @if ($errors->isEmpty())
                                    @foreach ($post->tags as $item)
                                        @if ($row->tag_id == $item->tag_id)
                                            checked
                                        @endif
                                    @endforeach
                                @else
                                    @foreach (old('tag') as $old)
                                        @if ($row->tag_id == $old)
                                            checked
                                        @endif
                                    @endforeach
                                @endif
                            >{{$row->tag_name}}
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
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