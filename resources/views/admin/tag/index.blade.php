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
                                <th>Tag Name</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tag->count() > 0)
                            @foreach ($tag as $row)
                            <tr>
                                <td>{{$row->tag_name}}</td>
                                <td><a href="{{route('tag.edit', ['id'=>$row->tag_id])}}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form action="{{route('tag.destroy', ['id'=>$row->tag_id])}}" method="post">
                                        {{ csrf_field() }}
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center text-danger">No Tag Found</td>
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