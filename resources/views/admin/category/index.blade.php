@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body table-resposive">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($category->count() > 0)
                            
                            @foreach ($category as $row)
                            <tr>
                                <td>{{$row->category_name}}</td>
                                <td>
                                    <a href="{{route('category.edit', ['id' => $row->category_id])}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form id="form" action="{{ route('category.destroy', ['id'=>$row->category_id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger tombol-hapus">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center text-danger">No Category Found</td>
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
            title: 'Apakah Anda Yakin Ingin Menghapus Category Ini Secara Permanent?',
            text: 'Menghapus Category Akan Menghapus Juga Portfolio Yang Berada Di Category Ini',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            width: '600px',
        }).then((result) => {
            if (result.value) {
                var form = document.getElementById('form');
                form.submit();
            }
        })
    });
</script>
@endsection