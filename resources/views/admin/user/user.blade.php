@extends('layouts.admin')

@section('content')
    <h1 class="page-header">User</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    User List
                </div>
                <div class="panel-body">
                    <div class="table-resposive">
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $row) 
                                <tr>
                                    <td><img src="{{asset($row->profile->avatar)}}" width="100px" height="100px"></td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->created_at->toformattedDateString()}}</td>
                                    <td>
                                        @if ($row->admin==1)
                                            <a href="#" class="btn btn-lg btn-success">Admin</a>
                                        @else
                                        <a href="#" class="btn btn-lg btn-danger">Not Admin</a>
                                        @endif
                                    </td>
                                    @if ($row->id!=Auth::id())
                                    <td>
                                        <a href="{{route('user.delete', ['id'=>$row->id])}}" class="btn btn-lg btn-danger">Trash</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection