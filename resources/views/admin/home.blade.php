@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$post->count()}}</h3>
                    
                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-edit"></i>
                </div>
                <a href="{{route('post.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
<<<<<<< HEAD

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>TASK</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
=======
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    
                    <p>Portfolio</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-star"></i>
                </div>
                <a href="{{route('home')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
>>>>>>> c6180bc15771ac75406a645c86ebcd9c6ceed4d0
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
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
        <div class="col-lg-3 col-6">
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