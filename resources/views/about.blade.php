@extends('layouts.frontend')

@section('content')

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">About Me</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-full s-content__main">
                <div class="row">
                    <div class="col-six tab-full text-center">
                        <img src="{{asset('storage/images/avatars/'.$profile->profile->avatar)}}" class="img-thumbnail img-fluid" width="50%">
                    </div>
                    <div class="col-six tab-full">
                        <h1>About</h1>
                        <p>My Name is {{$profile->name}}</p>
                        <p>{{$profile->profile->user_about}}</p>
                    </div>
                </div>
            </div> <!-- s-content__main -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->

@endsection