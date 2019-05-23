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
                <div class="table-responsive">

                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Desciption</th>
                                <th>Link To Github</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portfolio as $row)
                                <tr>
                                    <td width="250px">
                                        <a target="_blank" href="{{asset('storage/images/portfolio/'.$row->portfolio_image)}}">
                                            <img src="{{asset('storage/images/portfolio/'.$row->portfolio_image)}}" alt="" height="160px" width="240px">
                                        </a>
                                    </td>
                                    <td>{{$row->portfolio_name}}</td>
                                    <td>{!!$row->portfolio_desc!!}</td>
                                    <td width="180px"><a target="_blank" href="{{$row->portfolio_url}}"><i class="fab fa-github"></i> {{$row->portfolio_name}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div> <!-- s-content__main -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->

@endsection