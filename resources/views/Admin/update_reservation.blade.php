@extends('adminlte::page')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{-- @dd($reservations); --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('Realyupdate.reservation',['id'=>$reservation->id])}} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($reservation->user_type=='physical')
                        <p><strong>user id:</strong> <input type="text" name="user_id" value={{$reservation->user_p_id}}></p>
                        @else
                        <p><strong>user id:</strong> <input type="text" name="user_id" value={{$reservation->user_id}}></p>
                        @endif
                        <p><strong>room id:</strong> <input type="text" name="room_id" value={{$reservation->room_id}}></p>

                        <p><strong>number of guests</strong><input type="number" name="number_of_guests" value={{$reservation->number_of_guests}}></p>
                        <p><strong>the room type : </strong>{{$room->room_type}}</p>
                        {{-- <p><strong>room id:</strong><input type="text" name="room_id" value=""></p> --}}
                        <p><strong>room type:</strong>
                            <select name="room_type">
                            <option value="Premium Double">Premium Double</option>
                            <option value="Silver Double">Silver Double</option>
                            <option value="Premium Single">Premium Single</option>
                            <option value="Standard Double">Standard Double</option>
                            <option value="Standard Single">Standard Single</option>
                        </select></p>
                        <label for="reservation_start_time">Reservation Start Time:</label>
                        <input type="datetime-local" name="check_in" value={{Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d\TH:i') }} >
                        <br>
                        <label for="reservation_end_time">Reservation End Time:</label>
                        <input type="datetime-local" name="check_out" value={{Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d\TH:i') }} >
                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                        <input type="hidden" name="id" value={{$reservation->id}}>
                        <button type="submit">updete</button>
                    </form>
                    <h1><a href="/Admin/reservation">return</a></h1>
            </div>
        </div>
    </div>
</div>






@endsection


