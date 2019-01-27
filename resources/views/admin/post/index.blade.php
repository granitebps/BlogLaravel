@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Post</h1>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">Post List</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Post Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th colspan="3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($post->count() > 0)

                            @foreach ($post as $row)
                                <tr>
                                    <td>{{$row->post_title}}</td>
                                    <td width="150px">{{$row->user->name}}</td>
                                    <td width="150px">{{$row->category->category_name}}</td>
                                    <td width="250px">
                                        @foreach ($row->tags as $tag)
                                            {{$tag->tag_name. ', '}}
                                        @endforeach
                                    </td>
                                    <td width="200px">{{date('j F Y', strtotime($row->created_at))}}</td>
                                    <td width="100px" class="text-center">
                                        @if ($row->publish == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    </td>
                                    <td width="80px" class="text-center"><a href="{{route('post.edit', ['id'=>$row->post_id])}}" class="btn btn-primary">Edit</a></td>
                                    <td width="90px" class="text-center">
                                        <form action="{{route('post.destroy', ['id'=>$row->post_id])}}" method="post">
                                            {{ csrf_field() }}
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Trash</button>
                                        </form>
                                    </td>
                                    <td width="100px" class="text-center">
                                        @if ($row->publish == 1)
                                            <a href="{{route('post.draft', ['id'=>$row->post_id])}}" class="btn btn-default">UnPublish</a>
                                        @else
                                            <a href="{{route('post.draft', ['id'=>$row->post_id])}}" class="btn btn-default">Publish</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                                
                            @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">No Post Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$post->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection