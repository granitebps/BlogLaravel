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
                    <form action="{{route('portfolio.update', ['id'=>$portfolio->portfolio_id])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="form-group">
                            <label>
                                Image
                                <button type="button" class="btn btn-sm btn-success view" data-toggle="modal" data-target="#exampleModal" id="{{$portfolio->portfolio_id}}">
                                    View Current Image
                                </button>
                            </label>
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="exampleModalLabel">Preview Portfolio</h3>
                </div>
                <div class="modal-body">
                    <div id="preview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    {{-- <button type="button" class="btn btn-primary">Lanjutkan</button> --}}
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

    $(function() {
		$('.view').click(function(){  
			var id = $(this).attr("id");
			console.log('test');
			$('#preview').hide();
			$.ajax({  
				url:"/preview",  
				method:"GET",  
				data:{id:id},  
				success:function(data){  
					$('#preview').html(data);
					$('#preview').show();
				}  
			});  
		});
	});
</script>
@endsection