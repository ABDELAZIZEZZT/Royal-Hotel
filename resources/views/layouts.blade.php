<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> @yield('titel')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="{{asset('assets/img')}}/favicon.ico" rel="icon">
        <link href="{{asset('assets/img')}}/apple-favicon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <!-- Vendor CSS File -->
        <link href="{{asset('assets/vendor')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('assets/vendor')}}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{asset('assets/vendor')}}/animate/animate.min.css" rel="stylesheet">
        <link href="{{asset('assets/vendor')}}/slick/slick.css" rel="stylesheet">
        <link href="{{asset('assets/vendor')}}/slick/slick-theme.css" rel="stylesheet">
        <link href="{{asset('assets/vendor')}}/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="{{asset('assets/css')}}/hover-style.css" rel="stylesheet">
        <link href="{{asset('assets/css')}}/style.css" rel="stylesheet">
    </head>
    <header id="header">
        <a href="/" class="logo"><img src="{{asset('assets/img')}}/logo.jpg" alt="logo"></a>
        {{-- <div class="phone"><i class="fa fa-phone"></i>+1 234 567 8900</div> --}}
        <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>
        <nav class="main-menu top-menu">
            <ul>
                <li class="/active"><a href="/">Home</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/rooms">Rooms</a></li>
                <li><a href="/amenities">Amenities</a></li>
                {{-- <li><a href="/booking">Booking</a></li> --}}

                @if (!Auth::check())
                <li><a href="/login/view">Login</a></li>
                @endif

                <li><a href="/contact">Contact Us</a></li>
                @if(Auth::check() && Auth::user()->role === 'user')
                <li><a href="/profile{{Auth::user()->id}}">profile</a></li>
                @endif
                @if (Auth::check())
                    {{auth()->user()->name}}
                @endif
                @if(Auth::check() )
                <li> <form action={{ route('logout') }} method="post" class="d-flex" role="search">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form></li>
                @endif

                @if(Auth::check() && (Auth::user()->role === 'admin'||Auth::user()->role === 'owner') )
                <li><a href="/Admin">Admin</a></li>
                @endif

            </ul>
        </nav>
    </header>


    <section>
        @yield('content')
    </section>

        <!-- Call Section End -->

        <!-- Footer Section Start -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="social">

                            <a href="https://twitter.com/ZezoNassar20"><li class="fa fa-twitter"></li></a>
                            <a href="https://www.facebook.com/zezo.nassar.501"><li class="fa fa-facebook-f"></li></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>Copyright &#169; 2045 <a href="">Royal hotel</a> All Rights Reserved.</p>

						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						<p>Designed By <a href="https://htmlcodex.com">Abdelaziz Nassar</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Section End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Vendor JavaScript File -->
        <script src="{{asset('assets/vendor')}}/jquery/jquery.min.js"></script>
        <script src="{{asset('assets/vendor')}}/jquery/jquery-migrate.min.js"></script>
        <script src="{{asset('assets/vendor')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/vendor')}}/easing/easing.min.js"></script>
        <script src="{{asset('assets/vendor')}}/stickyjs/sticky.js"></script>
        <script src="{{asset('assets/vendor')}}/superfish/hoverIntent.js"></script>
        <script src="{{asset('assets/vendor')}}/superfish/superfish.min.js"></script>
        <script src="{{asset('assets/vendor')}}/wow/wow.min.js"></script>
        <script src="{{asset('assets/vendor')}}/slick/slick.min.js"></script>
        <script src="{{asset('assets/vendor')}}/tempusdominus/js/moment.min.js"></script>
        <script src="{{asset('assets/vendor')}}/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="{{asset('assets/vendor')}}/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="{{asset('assets/js')}}/jqBootstrapValidation.min.js"></script>
        <script src="{{asset('assets/js')}}/contact.js"></script>

        <!-- Main Javascript File -->
        <script src="{{asset('assets/js')}}/main.js"></script>



    </body>
</html>
