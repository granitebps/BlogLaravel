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
                    <form action="{{route('post.update', ['id'=>$post->post_id])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Featured Image | Maks : 2MB</label><br>
                            <img src="{{ asset('storage/images/posts/'.$post->featured) }}" width="20%" class="img-fluid img-thumbnail">
                            <input type="file" name="featured" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label>Post Title</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Post Title..." value="{{$errors->isEmpty() ? $post->post_title : old('post_title')}}" required>
                        </div>
                        <div class="form-group">
                            <label>Post Content</label>
                            <textarea name="post_content" cols="30" rows="10">{{$errors->isEmpty() ? $post->post_content: old('post_content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="" disabled selected>-- Select Category --</option>
                                @foreach ($category as $item)
                                    <option {{$post->category->category_id == $item->category_id ? 'selected' : ''}} value="{{$item->category_id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <select id="tag" name="tag[]" class="form-control" multiple="multiple">
                                @foreach ($tag_all as $item)
                                    <option 
                                    @foreach ($post->tags as $row)
                                        @if ($row->tag_id == $item->tag_id)
                                            selected="selected"
                                        @endif
                                    @endforeach
                                    value="{{$item->tag_name}}">{{$item->tag_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Edit</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_content', {filebrowserImageBrowseUrl: '/file-manager/ckeditor',height: '700px',});
    $("#tag").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>
@endsection