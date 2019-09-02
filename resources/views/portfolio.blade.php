@extends('layouts.frontend')

@section('content')

<!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">
        
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">My Portfolio</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-full s-content__main">
                @foreach ($portfolio as $index => $row)
                @php
                    $image = explode(',', $row->portfolio_image);
                    $folder = str_replace(' ', '_', strtolower($row->portfolio_name));
                @endphp
                    <h2>{{$index +1}}. {{$row->portfolio_name}}</h2>
                    <dl>
                        <dt><strong>Image</strong></dt>
                            <dd>
                                @foreach ($image as $item)
                                    <a target="_blank" href="{{asset('storage/images/portfolio/'.$folder.'/'.$item)}}"><img style="margin: 0 5px; display: inline;" src="{{asset('storage/images/portfolio/'.$folder.'/'.$item)}}" width="30%" alt=""></a>
                                @endforeach
                            </dd>
                        <dt><strong>Description</strong></dt>
                            <dd>{!!$row->portfolio_desc!!}</dd>
                        <dt><strong>Link</strong></dt>
                            <dd><a target="_blank" href="{{$row->portfolio_url}}">{{$row->portfolio_name}}</a></dd>
                    </dl>

                    <hr>
                @endforeach
            </div> <!-- s-content__main -->
        </div> <!-- end row -->
        
    </section> <!-- end s-content -->
    
    @endsection