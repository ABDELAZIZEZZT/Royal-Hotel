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
</div>
@endif



<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                @if ($type=='web')
                    <form action={{route('Realyupdate.user',['id'=>$user->id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><strong>name:</strong><input type="text" name="name" value={{$user->name}}></p>

                        <p><strong>email</strong><input type="email" name="email" value={{$user->email}}></p>
                        {{-- <p><strong>password</strong><input type="text" name="password" value={{$user->password}}></p> --}}
                        <p><strong>address</strong><input type="text" name="address" value={{$user->address}}></p>
                        <p><strong>phone number</strong><input type="text" name="phone_number" value={{$user->phone_number}}></p>
                        {{-- <p><strong>checked in:</strong>{{$user->check_in }}
                        <p><strong>checked in:</strong><input type="checkbox" name="check_in" value={{$user->check_out ? 'checked' : '0' }}></p>
                        <p><strong>checked out:</strong>{{$user->check_out }}
                        <p><strong>checked out:</strong><input type="checkbox" name="check_out" value={{$user->check_out ? 'checked' : '0' }}></p> --}}

                        <button type="submit">update</button>
                    </form>
                @else
                    <form action={{route('Realyupdate.p_user',['id'=>$user->id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><strong>name:</strong><input type="text" name="name" value={{$user->name}}></p>
                        <p><strong>address</strong><input type="text" name="address" value={{$user->address}}></p>
                        <p><strong>phone number</strong><input type="text" name="phone_number" value={{$user->phone_number}}></p>
                        <p><strong>nationl id</strong><input type="text" name="national_id" value={{$user->national_id}}></p>
                        {{-- <p><strong>checked in:</strong><input type="checkbox" name="check_in" value={{$user->check_in ? 'checked' : '0' }}></p>
                        <p><strong>checked out:</strong><input type="checkbox" name="check_out" value={{$user->check_out ? 'checked' : '0' }}></p> --}}
                        <button type="submit">update</button>
                    </form>
                @endif
                <h1>user reviews</h1><h3>for view</h3>
                @if (count($reviews)==0)
                    <p>no reviews from this user</p>
                @else
                    @foreach ($reviews as $review )
                        <p>id={{$review->id}}</p>
                        <p>user id={{$review->user_id}}</p>
                        <p>room id={{$review->room_id}}</p>
                        <p>room rate={{$review->rating_on_room}}</p>
                        <p>review over all={{$review->rating_overall}}</p>
                        <p>comment={{$review->comment}}</p>
                        <p>////////////////</p>
                    @endforeach
                @endif
                <h1>user reservations</h1><h3>for view</h3>
                @if ($reservations==null)
                    <p>no reservation yet</p>
                @else
                    @foreach ($reservations as $reservation )
                        <p>id={{$reservation->id}}</p>
                        <p>user id={{$reservation->user_id}}</p>
                        <p>room id={{$reservation->room_id}}</p>
                        <p>price={{$reservation->price}}</p>
                        <p>check in={{$reservation->check_in}}</p>
                        <p>cheeck out={{$reservation->check_out}}</p>
                        <p>number of guests={{$reservation->number_of_guests}}</p>
                        <p>////////////////</p>
                    @endforeach
                @endif
                <h1><a href="/Admin/web_user">return</a></h1>
            </div>
        </div>
    </div>
</div>

@endsection



