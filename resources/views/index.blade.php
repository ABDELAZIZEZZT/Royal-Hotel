@extends('layouts')
<!DOCTYPE html>
<html lang="en">

@section('titel','Home')
@section('content')


    <body>
        <!-- Header Section Start -->

        <!-- Header Section End -->

        <!-- Header Slider Start -->
        <div id="headerSlider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($slides as $index => $slide)
                    <li data-target="#headerSlider" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($slides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{asset('storage/photos/sliders/' . $slide['photo'])}}" alt="Slide {{ $index + 1 }}">
                        <div class="carousel-caption">
                            <h1 class="animated fadeInRight">{{ $slide['name'] }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><hr>
        <!-- Header Slider End -->

        <!-- Search Section Start -->

        <!-- Search Section End -->

        <!-- Welcome Section Start -->
        <div id="welcome">
            <div class="container">
                <h3>Welcome to Royal Hotel</h3>
                <p>Join our global loyalty programme for more rewards, greater access, and instant recognition.</p>
                <a href="/rooms">Book Now</a>
            </div>
        </div>
        <!-- Welcome Section End -->

        <!-- Amenities Section Start -->
        <div id="amenities" class="home-amenities">
            <div class="container">
                <div class="section-header">
                    <h2>Amenities & Services</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis, enim at venenatis tincidunt.
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-2"></i>
                        <h3>Air Conditioner</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-3"></i>
                        <h3>Bathtub</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-4"></i>
                        <h3>Shower</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-6"></i>
                        <h3>Television</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-7"></i>
                        <h3>WiFi</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-8"></i>
                        <h3>Telephone</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-9"></i>
                        <h3>Mini Bar</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-md-3 col-sm-6 icons">
                        <i class="icon icon-10"></i>
                        <h3>Kitchen</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Amenities Section Start -->

        <!-- Room Section Start -->
        <div id="rooms">
            <div class="container">
                <div class="section-header">
                    <h2>Our Rooms</h2>
                    <p>
                        Experience a lap of royalty, where luxury meets comfort right in the heart of New Cairo.
                    </p>
                </div>
                @foreach ($rooms as $room )

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="room-img">
                                    <div class="box12">
                                        <img src="{{asset('storage/photos/' .$room->Room_photos[0]->p_photo)}}">
                                        <div class="box-content">
                                            <h3 class="title">{{$room->name}}</h3>
                                            <ul class="icon">
                                                <span></span><li><a href="#" data-toggle="modal" data-target="#modal-id"><i class="fa fa-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="room-des">
                                    <h3><a href="#" data-toggle="modal" data-target="#modal-id">{{$room->room_type}}</a></h3>
                                    <p>{{$room->description}}</p>
                                    <ul class="room-size">
                                        <li><i class="fa fa-arrow-right"></i>Size: {{$room->size}}m </li>
                                        <li><i class="fa fa-arrow-right"></i>rating: {{$room->review}}/5 </li>
                                        <li><i class="fa fa-arrow-right"></i>up to: {{$room->num_guests}} Guests </li>
                                    </ul>
                                    {{-- <ul class="room-icon">
                                        <span title="Safe"><li class="icon-1"></li></span>
                                        <span title="Air Conditioner"><li class="icon-2"></li></span>
                                        <span title="Bathtub"><li class="icon-3"></li></span>
                                        <span title="Shower"><li class="icon-4"></li></span>
                                        <span title=""><li class="icon-5"></li></span>
                                        <span title="Television"><li class="icon-6"></li></span>
                                        <span title="WiFi"><li class="icon-7"></li></span>
                                        <span title="Telephone"><li class="icon-8"></li></span>
                                        <span title="Mini Bar"><li class="icon-9"></li></span>
                                    </ul> --}}
                                    <ul>
                                        <form action={{route('room.profile')}} method="post">
                                            @csrf
                                            @method("POST")
                                            {{-- @dd($s_check_in) --}}
                                            {{-- @if ($s_check_in!=null&&$s_check_out!=null)
                                                <input type="hidden" value="{{$s_check_in}}" name="check_in">
                                                <input type="hidden" value="{{$s_check_out}}" name="check_out">
                                            @endif --}}
                                            <input type="hidden" name="id" value="{{$room->id}}">
                                            <button  type="submit">Book Now</button>
                                        </form


                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="room-rate">
                                    <h3>From</h3>
                                    <h1>{{$room->price}}</h1>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @endforeach



                </div>
            </div>
        </div>
        <!-- Room Section End -->


        <!-- Call Section End -->
        <!-- Footer Section Start -->

        <!-- Footer Section End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Vendor JavaScript File -->


        <!-- Main Javascript File -->
        <script src="{{asset('assets/js')}}/main.js"></script>
    </body>
    @endsection
</html>
