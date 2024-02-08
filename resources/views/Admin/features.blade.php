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
            <li><a href="/Admin/features">features</a></li>
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

<h1><a href="/Admin/add_feature">add feature</a></h1>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>feature</th>
                            <th>price</th>
                            <th>update</th>
                            <th>delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($features as $feature)
                            <tr>

                                <td>{{ $feature->id }}</td>
                                <td>{{ $feature->feature }}</td>
                                <td>{{ $feature->price }}</td>
                                <td>
                                    <form action={{ route('feature.update',[$feature->id]) }} method="get">

                                        

                                        <button>update</button>
                                    </form>
                                </td>
                                <td>
                                    <form action={{ route('feature.delete') }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value={{$feature->id}}>
                                        <button>delete</button>
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



{{$features->links()}}
@endsection




