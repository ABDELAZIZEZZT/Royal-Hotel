@extends('layouts')
<!DOCTYPE html>
<html lang="en">
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
</div>
@endif
@section('titel','profile')
@section('content')


<body>
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-lg">
                <h6 class="card-header">
                    {{$user->name}}
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    @if ($photo)
                                    <img src="{{ asset('storage/photos/' . $photo->user_photo) }}" alt="user Photo"  width="350" height="400">
                                    @else
                                    <img src="{{ asset('storage/photos/user/Screenshot 2023-11-24 021340.png' ) }}" alt="user Photo">
                                    @endif
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box">
                                            <div class="box-body">
                                            <form action={{route('update.user.profile') }} method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <p><strong>name:</strong><input type="text" name="name" value="{{$user->name}}"></p>
                                                <p><strong>email : </strong>{{$user->email}}</p>
                                                {{-- <p><strong>password</strong><input type="text" name="password" value={{$user->password}}></p> --}}
                                                <p><strong>address:</strong><input type="text" name="address" value="{{$user->address}}"></p>
                                                <p><strong>phone number : {{$user->phone_number}}</strong>
                                                <p><strong>photo</strong><input type="file" name="photo" ></p>
                                                <button class="btn btn-xs btn-primary ml-15 w-sm-100p">update </button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <h1>user reviews</h1>
                    @if (count($reviews)==0)
                        <p>no reviews from this user</p>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>room id</th>
                                                <th>user id</th>
                                                <th>room review</th>
                                                <th>review over all</th>
                                                <th>comment</th>

                                                <th>room</th
                                                <!-- Add more columns as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reviews as $review)
                                                <tr>
                                                    <td>{{ $review->room_id }}</td>
                                                    <td>{{ $review->user_id }}</td>
                                                    <td>{{ $review->rating_on_room }}</td>
                                                    <td>{{ $review->rating_overall}}</td>
                                                    <td>{{ $review->comment }}</td>

                                                    <td>
                                                        <form action={{route('room.profile')}} method="get">
                                                           


                                                            <input type="hidden" name="id" value="{{$review->room_id}}">
                                                            <button  type="submit">room</button>
                                                        </form
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <h1>user reservations</h1>
                    @if (count($reservations)==0)
                        <p>no reservation yet</p>
                    @else
                    <div class="row">
                       <div class="col-md-12">
                           <div class="box">
                               <div class="box-body">
                                   <table class="table">
                                       <thead>
                                           <tr>
                                               <th>id</th>
                                               <th>check_in</th>
                                               <th>check_out</th>
                                               <th>number_guests</th>
                                               <th>price</th>
                                               <th>status</th>
                                               <th>room</th>
                                               <th>update</th>
                                               <th>add review</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach($reservations as $reservation)
                                               <tr>
                                                   <td> {{ $reservation->id }}</td>
                                                   <td>{{ $reservation->check_in }}</td>
                                                   <td>{{ $reservation->check_out }}</td>
                                                   <td>{{ $reservation->number_of_guests }}</td>
                                                   <td>{{ $reservation->price }}</td>
                                                   <td>{{ $reservation->status }}</td>
                                                   <td><a href="/Admin/update{{ $reservation->room_id}}">{{ $reservation->room_id }}</a></td>
                                                   <td>
                                                       <form action={{ route('rooms') }} method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="room_id" value="{{$reservation->room_id}}">
                                                        <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                                                        <button>update</button>
                                                       </form>
                                                   </td>
                                                   <td>

                                                        <form action={{route('room.profile')}} method="get">

                                                            <input type="hidden" name="room_id" value="{{$reservation->room_id}}">
                                                            <input type="hidden" name="reservation" value="{{}}">
                                                            <button>add review</button>
                                                        </form

                                                   </td>
                                               </tr>
                                           @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
@endsection
