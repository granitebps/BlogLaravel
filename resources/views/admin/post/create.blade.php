@extends('layouts.admin')

@section('style')
    {{-- Select2 --}}
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
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
                            <textarea name="post_content" id='article-ckeditor' cols="30" rows="10">{{$errors->isEmpty() ? '' : old('post_content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" disabled selected>-- Select Category --</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <select id="tag" name="tag[]" class="form-control" multiple="multiple">
                                @foreach ($tag as $item)
                                <option value="{{$item->tag_name}}">{{$item->tag_name}}</option>
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
    });
</script>
@endsection