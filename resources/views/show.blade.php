@extends('layouts.frontend')

@section('content')
    
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding s-content--narrow">

        <article class="row entry format-standard">

            <div class="entry__media col-full">
                <div class="entry__post-thumb">
                    <img src="{{asset($post->featured)}}" 
                        srcset="{{asset($post->featured)}} 2000w, 
                                {{asset($post->featured)}} 1000w, 
                                {{asset($post->featured)}} 500w" 
                        sizes="(max-width: 2000px) 100vw, 2000px" alt="">
                </div>
            </div>

            <div class="entry__header col-full">
                <h1 class="entry__header-title display-1">
                    {{$post->post_title}}
                </h1>
                <ul class="entry__header-meta">
                    <li class="date">{{$post->created_at->toFormattedDateString()}}</li>
                    <li class="byline">
                        By
                        <a href="#">{{$post->user->name}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-full entry__main">

                <p>{!! $post->post_content !!}</p>

                <div class="entry__taxonomies">
                    <div class="entry__cat">
                        <h5>Posted In: </h5>
                        <span class="entry__tax-list">
                            <a href="{{route('home.category', ['slug'=>$post->category->category_slug])}}">{{$post->category->category_name}}</a>
                        </span>
                    </div> <!-- end entry__cat -->

                    <div class="entry__tags">
                        <h5>Tags: </h5>
                        <span class="entry__tax-list entry__tax-list--pill">
                            @foreach ($post->tags as $item)
                                <a href="{{route('home.tag', ['slug'=>$item->tag_slug])}}">{{$item->tag_name}}</a>
                            @endforeach
                        </span>
                    </div> <!-- end entry__tags -->
                </div> <!-- end s-content__taxonomies -->

                Share This Post : 
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            

                <div class="entry__author">
                    <img src="{{asset($post->profile->avatar)}}" alt="">

                    <div class="entry__author-about">
                        <h5 class="entry__author-name">
                            <span>Posted by</span>
                            <a href="#">{{$post->user->name}}</a>
                        </h5>

                        <div class="entry__author-desc">
                            <p>
                            {{$post->profile->user_about}}
                            </p>
                        </div>
                    </div>
                </div>

            </div> <!-- s-entry__main -->

        </article> <!-- end entry/article -->


        <div class="s-content__entry-nav">
            <div class="row s-content__nav">
                @if ($prev_post)
                <div class="col-six s-content__prev">
                    <a href="{{route('home.show', ['slug'=>$prev_post->post_slug])}}" rel="prev">
                        <span>Previous Post</span>
                        {{$prev_post->post_title}}
                    </a>
                </div>
                @endif
                @if ($next_post)
                <div class="col-six s-content__next">
                    <a href="{{route('home.show', ['slug'=>$next_post->post_slug])}}" rel="next">
                        <span>Next Post</span>
                        {{$next_post->post_title}}
                    </a>
                </div>
                @endif
            </div>
        </div> <!-- end s-content__pagenav -->

        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">
                    <h3 class="h2">Comments</h3>
                    @include('layouts.disqus')

                </div> <!-- end col-full -->
            </div> <!-- end comments -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->

@endsection