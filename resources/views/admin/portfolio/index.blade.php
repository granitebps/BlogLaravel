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
                                <td width="250px"><img src="{{asset($row->portfolio_image)}}" alt="" width="240px" height="160px"></td>
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
@endsection