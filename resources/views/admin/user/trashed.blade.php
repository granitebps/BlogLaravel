@extends('layouts.admin')

@section('content')
    <h1 class="page-header">User</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Trashed User List
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
                                    <th>Deleted At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($user->count() > 0)
                                    @foreach ($user as $row)
                                    <tr>
                                        <td><img src="{{asset($row->profile->avatar)}}" width="100px" height="100px"></td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->created_at->toformattedDateString()}}</td>
                                        <td>{{$row->deleted_at->toformattedDateString()}}</td>
                                        <td class="text-center">
                                            <a href="{{route('user.restore', ['id'=>$row->id])}}" class="btn btn-lg btn-success">Restore</a>
                                            <a href="{{route('user.kill', ['id'=>$row->id])}}" class="btn btn-lg btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-danger">No Trashed User</td>
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