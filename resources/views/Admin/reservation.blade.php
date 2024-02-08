@extends('adminlte::page')
@section('content')

<head>

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

    <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>
    <nav class="main-menu top-menu">
        <ul>
            <li><a href="/Admin">Admin</a></li>
            @if(Auth::check() && Auth::user()->role === 'owner')




            <li><a href="/Admin/about">About Us</a></li>
            <li><a href="/Admin/rooms">Rooms</a></li>
            <li><a href="/Admin/web_user">web user</a></li>
            <li><a href="/Admin/admins">admins</a></li>
            <li><a href="/Admin/users">users</a></li>
            <li><a href="/">get out</a></li>
            @else

            <li><a href="/Admin/reservation">Reservation</a></li>
            <li><a href="/Admin/users">users</a></li>
            <li><a href="/Admin/review">reviews</a></li>
            <li><a href="/">get out</a></li>
            @endif
        </ul>
    </nav>
</header>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('reservation') }}" method="GET">
    <label for="reservation id">Reservation id:</label>
    <input type="number" name="id">
    <label for="reservation id">Room number:</label>
    <input type="number" name="room_number">
    <label for="check out">check out:</label>
    <input type="datetime-local" name="check_out">
    <button type="submit">Search</button>
</form>
@if ($found!='0')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>user_id</th>
                            <th>room_id</th>
                            <th>check_in</th>
                            <th>check_out</th>
                            <th>number_of_guests</th>
                            <th>price</th>
                            <th>status</th>
                            <th>delete</th>
                            <th>update</th>
                            <th>add review</th>
                            <th>check out</th>



                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($the_reservation as $reservation)
                            <tr>

                                <td> {{ $reservation->id }}</td>
                                @if ($reservation->user_type=='physical')
                                <td><a href="/Admin/user/{{$reservation->user_p_id}}/{{$reservation->user_type}}">{{ $reservation->user_p_id }}</a></td>
                                @else
                                <td><a href="/Admin/user/{{$reservation->user_id}}/{{$reservation->user_type}}">{{ $reservation->user_id }}</a></td>
                                @endif
                                <td><a href="/Admin/update{{ $reservation->room_id}}">{{ $reservation->room_id }}</a></td>
                                <td>{{ $reservation->check_in }}</td>
                                <td>{{ $reservation->check_out }}</td>
                                <td>{{ $reservation->number_of_guests }}</td>
                                <td>{{ $reservation->price }}</td>
                                <td>{{ $reservation->status }}</td>

                                <td>
                                    <form action={{ route('delete.room', ['id'=>$reservation->id]) }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button>delet</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('update.reservation', ['id'=>$reservation->id]) }} method="get">

                                        <button>update</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('admin.add_review') }} method="post">
                                       @csrf
                                       @method('POST')
                                        <input type="hidden" name="room_id" value={{$reservation->room_id}}>
                                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                                        @if ($reservation->user_type=='physical')
                                        <input type="hidden" name="user_id" value={{$reservation->user_p_id}}>
                                        @else
                                        <input type="hidden" name="user_id" value={{$reservation->user_id}}>
                                        @endif
                                        <button>add review</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('check.out') }} method="post">
                                        @csrf
                                       @method('POST')
                                        <input type="hidden" name="id" value={{$reservation->id}}>
                                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                                        <input type="hidden" name="user_id" value={{$reservation->user_id}}>
                                        <input type="hidden" name="room_id" value={{$reservation->room_id}}>

                                        <button>check out</button>
                                    </form>
                                </td>
                                <!-- Add more columns as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif


<h1><a href="/Admin/add_reservation">add reservation</a></h1>



<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>user_id</th>
                            <th>room_id</th>
                            <th>check_in</th>
                            <th>check_out</th>
                            <th>number_guests</th>
                            <th>price</th>
                            <th>status</th>
                            <th>delete</th>
                            <th>update</th>
                            <th>add review</th>
                            <th>check out</th>
                            <th>check in</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td> {{ $reservation->id }}</td>
                                @if ($reservation->user_type=='physical')
                                <td><a href="/Admin/user/{{$reservation->user_p_id}}/{{$reservation->user_type}}">{{ $reservation->user_p_id }}</a></td>
                                @else
                                <td><a href="/Admin/user/{{$reservation->user_id}}/{{$reservation->user_type}}">{{ $reservation->user_id }}</a></td>
                                @endif
                                <td><a href="/Admin/update{{ $reservation->room_id}}">{{ $reservation->room_id }}</a></td>
                                <td>{{ $reservation->check_in }}</td>
                                <td>{{ $reservation->check_out }}</td>
                                <td>{{ $reservation->number_of_guests }}</td>
                                <td>{{ $reservation->price }}</td>
                                <td>{{ $reservation->status }}</td>


                                <td>
                                    <form action={{ route('delete.reservation', ['id'=>$reservation->id]) }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button>delet</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('update.reservation', ['id'=>$reservation->id]) }} method="get">

                                        <button>update</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('admin.add_review') }} method="post">
                                       @csrf
                                       @method('POST')
                                        <input type="hidden" name="room_id" value={{$reservation->room_id}}>
                                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                                        @if ($reservation->user_type=='physical')
                                        <input type="hidden" name="user_id" value={{$reservation->user_p_id}}>
                                        @else
                                        <input type="hidden" name="user_id" value={{$reservation->user_id}}>
                                        @endif

                                        <button>add review</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('check.out') }} method="post">
                                        @csrf
                                       @method('POST')
                                        <input type="hidden" name="id" value={{$reservation->id}}>
                                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                                        <input type="hidden" name="user_id" value={{$reservation->user_id}}>
                                        <input type="hidden" name="room_id" value={{$reservation->room_id}}>

                                        <button>check out</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('check.in') }} method="post">
                                        @csrf
                                       @method('POST')
                                        <input type="hidden" name="id" value={{$reservation->id}}>
                                        <input type="hidden" name="user_type" value={{$reservation->user_type}}>
                                        <input type="hidden" name="user_id" value={{$reservation->user_id}}>
                                        <input type="hidden" name="room_id" value={{$reservation->room_id}}>

                                        <button>check in</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



{{$reservations->links()}}

@endsection




