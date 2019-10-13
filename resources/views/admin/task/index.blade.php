@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-left">{{$title}}</h3>
                    <a href="{{route('task.create')}}" class="btn btn-secondary btn-sm float-right">Create Task</a>
                </div>
                <div class="card-body table-resposive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Created At</th>
                                <th>Deadline</th>
                                <th colspan="3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($task->count() > 0)
                            @foreach ($task as $row)
                            <tr>
                                <td>{{$row->task}}</td>
                                <td>{{date('l d F Y', strtotime($row->created_at))}}</td>
                                <td>{{date('l d F Y', strtotime($row->deadline))}}</td>
                                @if (!$row->completed)
                                <td>
                                    <a href="{{route('task.edit', ['id'=> $row->id])}}" class="btn btn-primary">Edit Task</a>
                                </td>
                                <td>
                                    <a href="{{route('task.completed', ['id' => $row->id])}}" class="btn btn-success">Completed</a>
                                </td>
                                @else
                                <td colspan="2" class="text-center text-success">COMPLETED</td>
                                @endif
                                <td>
                                    <form action="{{route('task.destroy', ['id'=> $row->id])}}" method="post">
                                        {{ csrf_field() }}
                                        @method('delete')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No Data Found</td>
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