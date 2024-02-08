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
<form action="{{ route('web_users') }}" method="GET">
    <label for="name">name:</label>
    <input type="text" name="name">
    <label for="">phone number:</label>
    <input type="number" name="phone_number">
    <button type="submit">Search</button>
</form>
@if($found!=0)
<h1>web users</h1>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone_number</th>
                            <th>address</th>
                            <th>role</th>
                            <th>check in</th>
                            <th>check out</th>
                            <th>delete</th>
                            <th>user profile</th>


                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_s as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->check_in }}</td>
                                <td>{{ $user->check_out }}</td>

                                <td>
                                     <form action={{ route('delete.user', ['id'=>$user->id]) }} method="get">
                                        @csrf
                                        @method('DELETE')
                                        <button>delete</button>
                                    </form>
                                    {{-- @dd($user->id);
                                    <button onclick="confirmDeleteuser({{$user->id}})">delete</button>
                                    <script>
                                        function confirmDeleteuser(id) {
                                            var the_id = id;
                                            // console.log(the_id);


                                            var result = confirm("Are you sure you want to delete user with ID: " + id);
                                            if (result){
                                                 window.location.href ="{{route('delete.user', ['id' => ''])}} /"+the_id; ;
                                            }
                                        }
                                        </script>--}}

                                 </td>
                                <td>
                                    <form action={{ route('user_profile', ['id'=>$user->id,'type'=>'web']) }} method="get">

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
@endif


<h1><a href="/Admin/add_user">add user</a></h1>
<br>
<h1>web users</h1>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone_number</th>
                            <th>address</th>
                            <th>role</th>
                            <th>check in</th>
                            <th>check out</th>
                            <th>delete</th>
                            <th>user profile</th>


                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->check_in }}</td>
                                <td>{{ $user->check_out }}</td>

                                <td>
                                     <form action={{ route('delete.user', ['id'=>$user->id]) }} method="get">
                                        @csrf
                                        @method('DELETE')
                                        <button>delete</button>
                                    </form>
                                    {{-- @dd($user->id);
                                    <button onclick="confirmDeleteuser({{$user->id}})">delete</button>
                                    <script>
                                        function confirmDeleteuser(id) {
                                            var the_id = id;
                                            // console.log(the_id);


                                            var result = confirm("Are you sure you want to delete user with ID: " + id);
                                            if (result){
                                                 window.location.href ="{{route('delete.user', ['id' => ''])}} /"+the_id; ;
                                            }
                                        }
                                        </script>--}}

                                 </td>
                                <td>
                                    <form action={{ route('user_profile', ['id'=>$user->id,'type'=>'web']) }} method="get">

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
{{$users->links()}}
@endsection
