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
{{-- <h1><a href="/Admin/add_review">add review</a></h1> --}}

   <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>room id</th>
                            <th>user id</th>
                            <th>room review</th>
                            <th>review over all</th>
                            <th>comment</th>
                            <th>user type</th>
                            <th>room</th>
                            <th>user</th>



                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>{{ $review->room_id }}</td>
                                @if ($review->user_type=='physical')
                                <td>{{ $reservation->user_p_id }}</td>
                                @else
                                <td>{{ $review->user_id }}</td>
                                @endif
                                {{-- <td><a href="/Admin/update{{ $reservation->room_id}}">{{ $reservation->room_id }}</a></td> --}}
                                <td>{{ $review->rating_on_room }}</td>
                                <td>{{ $review->rating_overall}}</td>
                                <td>{{ $review->comment }}</td>
                                <td>{{ $review->user_type }}</td>
                                <td>
                                    <form action={{ route('update.room', ['id'=>$review->room_id ]) }} method="get">

                                        <button>room</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('user_profile', ['id'=>$review->user_id ,'type'=>$review->user_type]) }} method="get">
                                        <button>user</button>
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



{{$reviews->links()}}



@endsection




