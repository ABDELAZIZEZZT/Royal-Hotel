@extends("layouts")
<!DOCTYPE html>
<html lang="en">
    @section('titel','About us')
@section('content')


    <body>
        <!-- Header Section Start -->

        <!-- Header Section End -->

        <!-- About Section Start -->
        @foreach ($abouts as $about )

        <div id="about">
            <div class="container">
                <div class="section-header">
                    <h2>{{$about->head_line}}</h2>

                </div>
                <div class="row">
                    <div class="col-md-6 img-cols">
                        <div class="img-col">
                            <img class="img-fluid" src="{{ asset('storage/photos/' . $about->photo) }}" alt="Primary Photo">
                        </div>
                    </div>
                    <div class="col-md-6 content-cols">
                        <div class="content-col">

                            <p>
                            {{$about->description}}
                            </p>
                            <a href="{{$about->path}}">Learn More</a>
                        </div>
                    </div>
                </div>

                <hr>

        @endforeach

                <div class="row">
                    <div class="col-md-6 img-cols d-block d-md-none">
                        <div class="img-col">
                            <img class="img-fluid" src="{{asset('assets/img')}}/about/about-2.jpg">
                        </div>
                    </div>
                    <div class="col-md-6 content-cols">
                        <div class="content-col">
                            <h3>Lorem ipsum dolor</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla justo justo. Proin sodales bibendum pharetra. Aliquam blandit sapien eu nisl dictum pretium.
                            </p>
                            <p>
                                Nam fringilla justo justo. Proin sodales bibendum pharetra. Aliquam blandit sapien eu nisl dictum pretium.
                            </p>
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 img-cols d-none d-md-block">
                        <div class="img-col">
                            <img class="img-fluid" src="{{asset('assets/img')}}/about/about-2.jpg">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 img-cols">
                        <div class="img-col">
                            <img class="img-fluid" src="{{asset('assets/img')}}/about/about-3.jpg">
                        </div>
                    </div>
                    <div class="col-md-6 content-cols">
                        <div class="content-col">
                            <h3>Lorem ipsum dolor</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla justo justo. Proin sodales bibendum pharetra. Aliquam blandit sapien eu nisl dictum pretium.
                            </p>
                            <p>
                                Nam fringilla justo justo. Proin sodales bibendum pharetra. Aliquam blandit sapien eu nisl dictum pretium.
                            </p>
                            <a href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Section End -->
@endsection
        <!-- Footer Section Start -->

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

        <!-- Booking Javascript File -->
        <script src="{{asset('assets/js')}}/booking.js"></script>
        <script src="{{asset('assets/js')}}jqBootstrapValidation.min.js"></script>

        <!-- Main Javascript File -->
        <script src="{{asset('assets/js')}}/main.js"></script>
    </body>
</html>
