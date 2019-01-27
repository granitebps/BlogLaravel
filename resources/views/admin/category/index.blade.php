@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Category</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Category List
                </div>
                <div class="panel-body">
                    <div class="table-resposive">
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
                                        <a href="{{route('category.delete', ['id' => $row->category_id])}}" class="btn btn-danger tombol-hapus">Delete</a>
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