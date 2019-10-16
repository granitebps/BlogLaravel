@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$post->count()}}</h3>
                    
                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-edit"></i>
                </div>
                <i href="{{route('post.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></i>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$message->count()}}</h3>
                    
                    <p>Message UnRead</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email-unread"></i>
                </div>
                <a href="{{route('message.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$subs->count()}}</h3>
                    
                    <p>Subscriber</p>
                </div>
                <div class="icon">
                    <i class="ion ion-trophy"></i>
                </div>
                <a href="{{route('subs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>

@endsection