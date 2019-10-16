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
                            <tr>
                                <td>{{$row->post_title}}</td>
                                <td>{{$row->user->name}}</td>
                                <td>{{$row->category->category_name}}</td>
                                <td>
                                    @foreach ($row->tags as $tag)
                                    {{$tag->tag_name. ', '}}
                                    @endforeach
                                </td>
                                <td>{{\Carbon\Carbon::parse($row->created_at)->format('d F Y, H:i')}}</td>
                                @if ($row->publish == 1)
                                    <td class="table-success">
                                        Published
                                    </td>
                                    @else
                                    <td class="table-primary">
                                        Draft
                                    </td>
                                    @endif
                                <td class="text-center"><a href="{{route('post.edit', ['id'=>$row->post_id])}}" class="btn btn-primary">Edit</a></td>
                                <td class="text-center">
                                    <a href="{{route('post.destroy', ['id'=>$row->post_id])}}" class="btn btn-danger">Trash</a>
                                </td>
                                <td class="text-center">
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
                                <td colspan="7" class="text-center text-danger">No Post Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$post->appends(request()->query())->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection