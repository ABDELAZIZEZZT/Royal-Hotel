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

<h1><a href="/Admin/add_about">add section</a></h1>
@foreach ($about as $ab )

<div id="about">
    <div class="container">
        <div class="section-header">
            <h2>About Royal Hotel</h2>
            <p>

            </p>
        </div>
        <div class="row">
            <div class="col-md-6 img-cols">
                <div class="img-col">
                    <img src="{{ asset('storage/photos/' . $ab->photo) }}" alt="Primary Photo">
                </div>
            </div>
            <div class="col-md-6 content-cols">
                <div class="content-col">
                    <h3> {{$ab->description}}</h3>
                    <p>
                        {{$ab->head_line}}
                    </p>
                    <a href={{$ab->path}}>Learn More</a>
                </div>
            </div>
        </div>
        <form action={{ route('update.about', ['id'=>$ab->id]) }} method="get">

            <button>update</button>
        </form>
        <form action={{ route('delete.about', ['id'=>$ab->id]) }} method="post">
            @csrf
            @method('DELETE')
            <button>delet</button>
        </form>

@endforeach

@endsection




