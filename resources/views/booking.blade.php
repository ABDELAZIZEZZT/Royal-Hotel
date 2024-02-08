@extends('layouts')
<!DOCTYPE html>
<html lang="en">
    @section('titel','Booking')
@section('content')
    <body>
        <!-- Header Section Start -->

        <!-- Header Section End -->

        <!-- Search Section Start -->

        {{-- check_in
        check_out
        room_id
        room_number
        num_guests
        price --}}
        <!-- Search Section End -->

        <!-- Booking Section Start -->
        <div id="booking">
            <div class="container">
                <div class="section-header">
                    <h2>Room Booking</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="booking-form">
                            <div id="success"></div>
                            <form action={{route('booking.check')}} method="post">
                                @csrf
                                @method("POST")
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label> Name</label><strong>{{auth()->user()->name}}</strong>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label> check in date</label><strong>{{$check_in}}</strong>
                                        <input type="hidden" name="check_in" value="{{$check_in}}">
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label> check out date</label><strong>{{$check_out}}</strong>
                                        <input type="hidden" name="check_out" value="{{$check_out}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Room number</label><strong>{{$room_number}}</strong>
                                        <input type="hidden" name="room_number" value="{{$room_number}}">
                                        <input type="hidden" name="room_id" value="{{$room_id}}">
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>number of guests</label><strong>{{$num_guests}}</strong>
                                        <input type="hidden" name="num_guest" value="{{$num_guests}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Price over all with out features</label><strong>{{$total_price}}</strong>
                                        <input type="hidden" name="price" value="{{$total_price}}">
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Price over all with features</label><strong>{{$total_price_f}}</strong>
                                        <input type="hidden" name="price" value="{{$total_price_f}}">
                                    </div>
                                </div>
                                <label>your selected features</label>
                                @if ($features!=null)


                                    @foreach ($features as $feature )

                                    <div class="form-row">
                                        <div class="control-group col-md-6">
                                            <label>{{$feature}}</label>
                                        </div>
                                    </div>

                                    <input type="hidden" name="features[]" value="{{$feature}}">
                                    @endforeach
                                @endif

                                <input type="hidden" name="id" value="{{$id}}">



                                <div class="button"><button type="submit" id="bookingButton">Book Now</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Section End -->

        <!-- Footer Section Start -->

        <!-- Footer Section End -->

    </body>
    @endsection
</html>
