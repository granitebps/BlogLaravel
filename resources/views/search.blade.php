@extends('layouts.frontend')

@section('content')

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">Search: </h1>
            </div>
        </div>
        
        <div class="row entries-wrap add-top-padding wide">
            <div class="entries">

                @foreach ($post as $row)
                    
                <article class="col-block">
                    
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="{{route('home.show', ['slug'=>$row->post_slug])}}" class="item-entry__thumb-link">
                                <img src="{{asset($row->featured)}}" 
                                    srcset="{{asset($row->featured)}} 1x, {{asset($row->featured)}} 2x" alt="">
                            </a>
                        </div>
        
                        <div class="item-entry__text">
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

        @if ($post->hasPages())
            <div class="row pagination-wrap">
                <div class="col-full">
                    <nav class="pgn" data-aos="fade-up">
                        <ul>    
                            @if (!$post->onFirstPage())
                            <li><a class="pgn__prev" href="{{$post->previousPageUrl()}}">Prev</a></li>
                            @endif
                            @for ($i = 1; $i <= $post->total(); $i++)
                            <li><a class="pgn__num" href="{{$post->url($i)}}">{{$i}}</a></li>
                            @endfor
                            @if ($post->currentPage() != $post->lastPage())
                            <li><a class="pgn__next" href="{{$post->nextPageUrl()}}">Next</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @endif

    </section> <!-- end s-content -->

@endsection