@extends('layouts.frontend')

@section('content')
    
    <!-- featured 
    ================================================== -->
    <section class="s-featured">
        <div class="row">
            <div class="col-full">

                <div class="featured-slider featured" data-aos="zoom-in">

                    @foreach ($featured as $row)
                    <div class="featured__slide">
                        <div class="entry">

                            <div class="entry__background" style="background-image:url('{{'storage/images/posts/'.$row->featured}}');"></div>
                            
                            <div class="entry__content">
                                <span class="entry__category"><a href="{{route('home.category', ['slug'=>$row->category->category_slug])}}">{{$row->category->category_name}}</a></span>

                                <h1><a href="{{route('home.show', ['slug'=>$row->post_slug])}}">{{$row->post_title}}</a></h1>

                                <div class="entry__info">
                                    <a href="#" class="entry__profile-pic">
                                        <img class="avatar" src="{{asset('storage/images/avatars/'.$row->profile->avatar)}}" alt="">
                                    </a>
                                    <ul class="entry__meta">
                                        <li><a href="#0">{{$row->user->name}}</a></li>
                                        <li>{{$row->created_at->toFormattedDateString()}}</li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->
                            
                        </div> <!-- end entry -->
                    </div> <!-- end featured__slide -->
                    @endforeach
                    
                </div> <!-- end featured -->

            </div> <!-- end col-full -->
        </div>
    </section> <!-- end s-featured -->


    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row entries-wrap wide">
            <div class="entries">

                @foreach ($post as $row)
                <article class="col-block">
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="{{route('home.show', ['slug'=>$row->post_slug])}}" class="item-entry__thumb-link">
                                <img src="{{asset('storage/images/posts/'.$row->featured)}}" 
                                    srcset="{{asset('storage/images/posts/'.$row->featured)}} 1x, {{asset('storage/images/posts/'.$row->featured)}} 2x" alt="">
                            </a>
                        </div>
        
                        <div class="item-entry__text">    
                            <div class="item-entry__cat">
                                <a href="{{route('home.category', ['slug'=>$row->category->category_slug])}}">{{$row->category->category_name}}</a> 
                            </div>
    
                            <h1 class="item-entry__title"><a href="{{route('home.show', ['slug'=>$row->post_slug])}}">{{$row->post_title}}</a></h1>
                                
                            <div class="item-entry__date">
                                <a href="{{route('home.show', ['slug'=>$row->post_slug])}}">{{$row->created_at->toFormattedDateString()}}</a>
                            </div>
                        </div>
                    </div> <!-- item-entry -->
                </article> <!-- end article -->
                @endforeach

            </div> <!-- end entries -->
        </div> <!-- end entries-wrap -->
        
        {{$post->links()}}        
    </section> <!-- end s-content -->

@endsection