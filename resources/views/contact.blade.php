@extends('layouts.frontend')

@section('content')

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">Contact Me</h1>
                <p class="lead">
                    {{$profile->profile->user_about}}
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-full s-content__main">
                <div class="row">
                    <div class="col-six tab-full">
                        <h4>Where to Find Me</h4>

                        <p>
                            {{$profile->profile->address}}
                        </p>

                    </div>

                    <div class="col-six tab-full">
                        <h4>Contact Info</h4>

                        <p>Email : {{$profile->email}}<br>
                        Phone : {{$profile->profile->contact_number}}<br>
                        Github : <a target="_blank" href="{{$profile->profile->github}}"><i class="fab fa-github"> Github</i></a><br>
                        Linkedin : <a target="_blank" href="{{$profile->profile->linkedin}}"><i class="fab fa-linkedin"> Linkedin</i></a><br>
                        </p>

                    </div>

                    <h4>Get In Touch</h4>

                    <form name="cForm" id="cForm" class="contact-form" method="post" action="{{route('home.email')}}">
                        {{ csrf_field() }}
                        <fieldset>

                            <div>
                                <input required name="name" id="cName" class="full-width" placeholder="Your Name*" value="" type="text">
                            </div>

                            <div class="form-field">
                                <input required name="email" id="cEmail" class="full-width" placeholder="Your Email*" value="" type="email">
                            </div>

                            <div class="message form-field">
                            <textarea required name="message" id="cMessage" class="full-width" placeholder="Your Message*"></textarea>
                            </div>

                            <button type="submit" class="submit btn btn--primary btn--large full-width">Send Message</button>

                        </fieldset>
                    </form>

                </div>
            </div> <!-- s-content__main -->
        </div> <!-- end row -->

    </section> <!-- end s-content -->

@endsection