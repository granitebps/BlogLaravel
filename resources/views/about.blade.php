@extends('layouts.frontend')

@section('content')

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">About {{$setting->site_name}}</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-full s-content__main">
                {!!$setting->about!!}
            </div> <!-- s-content__main -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->

@endsection