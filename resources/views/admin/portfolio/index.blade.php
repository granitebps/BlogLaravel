@extends('layouts.admin')

@section('content')
<h1 class="page-header">Portfolio</h1>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-heading">Portfolio List</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Description</th>
							<th>Link</th>
							<th colspan="2" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@if ($portfolio->count() > 0)
						@foreach ($portfolio as $row)
						<tr>
							<td width="250px">
								<button type="button" class="btn btn-success view" data-toggle="modal" data-target="#exampleModal" id="{{$row->portfolio_id}}">
									Preview
								</button>
								{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
									Preview
								</button> --}}
							</td>
							<td>{{$row->portfolio_name}}</td>
							<td>{!!$row->portfolio_desc!!}</td>
							<td width="250px">{{$row->portfolio_url}}</td>
							<td width="80px">
								<a href="{{route('portfolio.edit', ['id'=>$row->portfolio_id])}}" class="btn btn-primary">Edit</a>
							</td>
							<td width="100px">
								<form action="{{route('portfolio.destroy', ['id'=>$row->portfolio_id])}}" method="post">
									{{ csrf_field() }}
									@method('delete')
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="6" class="text-center text-danger">No Portfolio Found</td>
						</tr>
						@endif
					</tbody>
				</table>
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