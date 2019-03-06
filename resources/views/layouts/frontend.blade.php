<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>GBPS MyMind</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('css/base.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- script
    ================================================== -->
    <script src="{{asset('js/modernizr.js')}}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <!-- Toastr 
    ================================================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    {{-- Google Analytics
    ================================================== --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133810181-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-133810181-1');
    </script>


</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

        <!-- header
    ================================================== -->
    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="{{route('home.welcome')}}">
                <img src="{{asset('images/logo.svg')}}" alt="Homepage">
            </a>
        </div> <!-- end header__logo -->

        <a class="header__search-trigger" href="#0"></a>
        <div class="header__search">

            <form role="search" method="get" class="header__search-form" action="{{route('home.search')}}">
                <label>
                    <span class="hide-content">Search for:</span>
                    <input type="search" class="search-field" placeholder="Type Keywords" value="" name="search" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>

            <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

        </div>  <!-- end header__search -->

        <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li class="current"><a href="{{route('home.welcome')}}" title="">Home</a></li>
                @foreach ($category as $row)
                    <li><a href="{{route('home.category', ['slug'=>$row->category_slug])}}" title="">{{$row->category_name}}</a></li>
                @endforeach
                <li><a href="{{route('home.about')}}" title="">About</a></li>
                <li><a href="{{route('home.contact')}}" title="">Contact</a></li>
                <li><a href="{{route('home.portfolio')}}" title="">Portfolio</a></li>
            </ul> <!-- end header__nav -->

            <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->

    @yield('content')

    <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row">

            <div class="col-seven md-six tab-full popular">
                <h3>Random Posts</h3>

                <div class="block-1-2 block-m-full popular__posts">
                    @foreach ($random as $item)
                        <article class="col-block popular__post">
                            <a href="{{route('home.show', ['slug'=>$item->post_slug])}}" class="popular__thumb">
                                <img src="{{asset($item->featured)}}" alt="">
                            </a>
                            <h5>{{$item->post_title}}</h5>
                            <section class="popular__meta">
                                <span class="popular__author"><span>By</span> <a href="#0">{{$item->user->name}}</a></span>
                                <span class="popular__date"><span>on</span> <time datetime="2018-06-14">{{$item->created_at->toFormattedDateString()}}</time></span>
                            </section>
                        </article>
                    @endforeach
                </div> <!-- end popular_posts -->
            </div> <!-- end popular -->

            <div class="col-four md-six tab-full end">
                <div class="row">
                    <div class="col-six md-six mob-full categories">
                        <h3>Categories</h3>
        
                        <ul class="linklist">
                            @foreach ($category as $row)
                                <li><a href="{{route('home.category', ['slug'=>$row->category_slug])}}">{{$row->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div> <!-- end categories -->
        
                    <div class="col-six md-six mob-full sitelinks">
                        <h3>Tags</h3>
        
                        <ul class="linklist">
                            @foreach ($tag as $row)
                                <li><a href="{{route('home.tag', ['slug'=>$row->tag_slug])}}">{{$row->tag_name}}</a></li>
                            @endforeach
                        </ul>
                    </div> <!-- end sitelinks -->
                </div>
            </div>
        </div> <!-- end row -->

    </section> <!-- end s-extra -->

    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">
                
                <div class="col-six tab-full s-footer__about">
                        
                    <h4>About {{$setting->site_name}}</h4>

                    <div class="col-twelve">
                        <ul class="footer-social">
                            <li>
                                <a target="_blank" href="https://github.com/granitebps"><i class="fab fa-github"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/granitebps"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.twitter.com/granitbps"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/granitebps"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.youtube.com/channel/UCcMqEJTGebhR8RodKMJey7Q"><i class="fab fa-youtube"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.linkedin.com/in/granitebps"><i class="fab fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>

                </div> <!-- end s-footer__about -->

                <div class="col-six tab-full s-footer__subscribe">
                        
                    <h4>Our Newsletter</h4>

                    <p>Subscribe Untuk Menerima Notifikasi Apabila Website Ini Membuat Post</p>

                    <div class="subscribe-form">
                        <form id="mc-form" class="group" method="POST" action="{{route('home.subs')}}">
                            {{ csrf_field() }}
                            <input type="email" value="" name="subs" class="email" id="mc-email" placeholder="Email Address" required="">
                
                            <input type="submit" name="subscribe" value="Send">
                
                        </form>
                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">

                <div class="col-twelve">
                    <div class="s-footer__copyright">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</span>
                    </div>
                </div>
                
            </div>
        </div> <!-- end s-footer__bottom -->

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

    </footer> <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c2570ddd5b72cc7"></script>  

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    {{-- Toastr --}}
    <script>
        @if($errors->count() > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{$error}}")
            @endforeach
        @endif
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
        @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}")
        @endif
    </script>

</body>

</html>