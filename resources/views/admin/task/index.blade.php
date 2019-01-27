@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Task</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    Task List
                </div>
                <div class="panel-body">
                    <a href="{{route('task.create')}}" class="btn btn-lg btn-default">Create Task</a>
                    <div class="table-resposive">
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Created At</th>
                                    <th>Deadline</th>
                                    <th colspan="3" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection