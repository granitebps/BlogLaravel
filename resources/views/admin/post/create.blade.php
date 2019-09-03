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
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($category as $row)
                                <option value="{{$row->category_id}}"
                                    @if (!$errors->isEmpty() && $row->category_id == old('category_id'))
                                    selected
                                    @endif    
                                    >{{$row->category_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <select id="tag" name="tag[]" class="form-control" multiple="multiple">
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
    
    $(document).ready(function() {
        $('#tag').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>
@endsection