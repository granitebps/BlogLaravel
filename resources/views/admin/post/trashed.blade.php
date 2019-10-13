@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>Post Title</th>
                                <th>Tag</th>
                                <th>Created At</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($post->count() > 0)
                            
                            @foreach ($post as $row)
                            <tr>
                                <td>{{$row->post_title}}</td>
                                <td>
                                    @foreach ($row->tags as $tag)
                                    {{$tag->tag_name. ', '}}
                                    @endforeach
                                </td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->deleted_at}}</td>
                                <td>
                                    <a href="{{route('post.restored', ['id'=>$row->post_id])}}" class="btn btn-success">Restore</a>
                                </td>
                                <td>
                                    <a href="{{route('post.killed', ['id'=>$row->post_id])}}" class="btn btn-danger tombol-hapus">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            
                            @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">No Trashed Post Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('.tombol-hapus').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');
        Swal({
            title: 'Apakah Anda Yakin Ingin Menghapus Post Ini Secara Permanent?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            width: '600px',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
</script>
@endsection