@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
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
                            <tr class="{{($row->publish == 1) ? '' : 'bg-info'}}">
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
                                    <a href="{{route('post.draft', ['id'=>$row->post_id])}}" class="btn btn-secondary">UnPublish</a>
                                    @else
                                    <a href="{{route('post.draft', ['id'=>$row->post_id])}}" class="btn btn-secondary">Publish</a>
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
                        {{$post->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection