@extends('layouts.admin')

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <h1 class="page-heading">Post</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">Create Post</div>
            <div class="panel-body">
                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Featured Image | Maks : 2MB</label>
                        <input type="file" name="featured" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="post_title" class="form-control" placeholder="Post Title..." required value="{{$errors->isEmpty() ? '' : old('post_title')}}">
                    </div>
                    <div class="form-group">
                        <label>Post Content</label>
                        <textarea name="post_content" cols="30" rows="10">{{$errors->isEmpty() ? '' : old('post_content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value="" selected disabled>-- Select Category --</option>
                            @foreach ($category as $row)
                                <option value="{{$row->category_id}}"
                                    @if (!$errors->isEmpty() && $row->category_id == old('category_id'))
                                        selected
                                    @endif    
                                >{{$row->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        <select class="form-control" multiple="multiple" id="tag" name="tag[]">
                            @foreach ($tag as $item)
                                <option value="{{$item->tag_id}}">{{$item->tag_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Publish</button>
                </form>
                <hr>
                <a href="{{ route('post.index') }}" class="btn btn-warning btn-block">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('post_content', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});

        $(document).ready(function() {
            $("#tag").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
@endsection