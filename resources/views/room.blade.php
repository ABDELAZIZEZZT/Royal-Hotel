@extends('layouts')

@section('titel','Rooms')
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <body>
        <!-- Header Section Start -->

        <!-- Header Section End -->

        <!-- Search Section Start -->
        <form action="{{route('get.room')}}" method="POST">

            @if ($selected_room!=null)
                @csrf
                @method("PUT")
                <input type="hidden" name="reservation_id" value="{{$reservation_id}}">
                <input type="hidden" name="selected_room" value="{{$selected_room[0]}}">
                <input type="hidden" name="id" value="{{$selected_room[0]->id}}">

            @elseif ($selected_room==null)
                @csrf
                @method("POST")
            @endif
            <div id="search" style="background: #ffffff;">
                <div class="container">
                    <div class="form-row">
                        <div class="control-group col-md-3">
                            <label>Check-In</label>
                            <div class="form-group">
                                <div class="input-group date" id="date-3" data-target-input="nearest">
                                    <input type="text" name="check_in" class="form-control datetimepicker-input" data-target="#date-3" required/>
                                    <div class="input-group-append" data-target="#date-3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label>Check-Out</label>
                            <div class="form-group">
                                <div class="input-group date" id="date-4" data-target-input="nearest">
                                    <input type="text" name="check_out" class="form-control datetimepicker-input" data-target="#date-4" required/>
                                    <div class="input-group-append" data-target="#date-4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <div class="form-row">
                                <div class="control-group col-md-3">
                                    <label>Guest</label>
                                    <select class="custom-select" name="guest">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="control-group col-md-2">
                            <button class="btn btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <!-- Search Section End -->

        <!-- Room Section Start -->
        <div id="rooms">
            <div class="container">

                @if ($selected_room!=null)
                <h5>yor selected room is</h5>
                <p>the previos check in {{$s_check_in}}, the previos check out {{$s_check_out}}</p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="room-img">
                            <div class="box12">
                                <img src="{{asset('storage/photos/' .$selected_room[0]->Room_photos[0]->p_photo)}}">
                                <div class="box-content">
                                    <h3 class="title">{{$selected_room[0]->name}}</h3>
                                    <ul class="icon">
                                        <span></span><li><a href="#" data-toggle="modal" data-target="#modal-id"><i class="fa fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-des">
                            <h3><a href="#" data-toggle="modal" data-target="#modal-id">{{$selected_room[0]->room_type}}</a></h3>
                            <p>{{$selected_room[0]->description}}</p>
                            <ul class="room-size">
                                <li><i class="fa fa-arrow-right"></i>Size: {{$selected_room[0]->size}}m </li>
                                <li><i class="fa fa-arrow-right"></i>up to: {{$selected_room[0]->num_guests}} Guests </li>
                            </ul>

                            <ul>
                                <form action={{route('room.profile')}} method="post">
                                    @csrf
                                    @method("POST")

                                    @if ($s_check_in!=null&&$s_check_out!=null)
                                        <input type="hidden" value="{{$s_check_in}}" name="check_in">
                                        <input type="hidden" value="{{$s_check_out}}" name="check_out">
                                    @endif
                                    <input type="hidden" name="id" value="{{$selected_room[0]->id}}">
                                    <button  type="submit">Book Now</button>
                                </form

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="room-rate">
                            <h3>From</h3>
                            <h1>{{$selected_room[0]->price}}</h1>
                        </div>
                    </div>
                </div>
                <hr>
            </div>




        </div>


        @endif

        <div id="rooms">
            <div class="container">
                <div class="section-header">
                    <h2>Our Rooms</h2>
                    <p>
                        Experience a lap of royalty, where luxury meets comfort right in the heart of New Cairo.
                    </p>
                </div>

                <div class="row">
                    @foreach ($rooms as $room )
                    @if($selected_room)
                        @if ($room->id==$selected_room[0]->id)
                            @continue
                        @endif
                    @endif
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="room-img">
                                    <div class="box12">
                                        {{$hasPhoto = count($room->Room_photos)}}
                                        @if ($hasPhoto!=0)
                                        <img src="{{asset('storage/photos/' .$room->Room_photos[0]->p_photo)}}">
                                        @else
                                        <img src="{{asset('storage/photos/1707136813_room-4.jpg')}}">
                                        @endif
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
                                        <li><i class="fa fa-arrow-right"></i>up to: {{$room->num_guests}} Guests </li>
                                    </ul>

                                    <ul>
                                        <form action={{route('room.profile')}} method="post">
                                            @csrf
                                            @method("POST")

                                            @if ($s_check_in!=null&&$s_check_out!=null)
                                                <input type="hidden" value="{{$s_check_in}}" name="check_in">
                                                <input type="hidden" value="{{$s_check_out}}" name="check_out">
                                            @endif
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

        <!-- Modal for Room Section Start -->


    </body>
    @endsection

