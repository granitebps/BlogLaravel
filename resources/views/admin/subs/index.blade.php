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
                    <div class="table-resposive">
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>Subs Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($subs->count() > 0)
                                
                                @foreach ($subs as $row)
                                <tr>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        <a href="{{ route('subs.destroy', ['id'=>$row->email_id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No Subs Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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
            title: 'Apakah Anda Yakin Ingin Menghapus Category Ini Secara Permanent?',
            text: 'Menghapus Category Akan Menghapus Juga Post Yang Berada Di Category Ini',
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