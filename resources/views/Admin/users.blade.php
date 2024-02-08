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
{{-- <h1><a href="/Admin/add_user">add user</a></h1>
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
                            <th>update</th>


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
                                    {{-- <form action={{ route('delete.user', ['id'=>$user->id]) }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button>delet</button>
                                    </form> --}}
                                    {{-- <script>
                                        function confirmDeleteuser() {
                                            var result = confirm("Are you sure you want to delete this user?");
                                            if (result) {
                                                // User confirmed, proceed with the deletion
                                                window.location.href = "{{  route('delete.user', ['id'=>$user->id]) }}";
                                            }
                                        }
                                    </script>

                                    <button onclick="confirmDeleteuser()">delete</button> --}}
                                {{-- </td>
                                <td>
                                    <form action={{ route('update.user', ['id'=>$user->id]) }} method="get">

                                        <button>update</button>
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
{{$users->links()}} --}}




<h1>physical users</h1>
<h1><a href="/Admin/add_p_user">add physical user</a></h1>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>phone_number</th>
                            <th>address</th>
                            <th>national_id</th>
                            <th>check in</th>
                            <th>check out</th>
                            <th>delete</th>
                            <th>update</th>


                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($p_users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->national_id }}</td>
                                <td>{{ $user->check_in }}</td>
                                <td>{{ $user->check_out }}</td>


                                <td>
                                    {{-- <form action={{ route('delete.user', ['id'=>$user->id]) }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="physical">
                                        <button>delete</button>
                                    </form> --}}
                                    <script>
                                        function confirmDelete() {
                                            var result = confirm("Are you sure you want to delete this user?");
                                            if (result) {
                                                // User confirmed, proceed with the deletion
                                                window.location.href = "{{  route('delete.physical_user', ['id'=>$user->id]) }}";
                                            }
                                        }
                                    </script>

                                    <button onclick="confirmDelete()">delete</button>

                                </td>
                                <td>

                                    <form action={{ route('update.p_user', ['id'=>$user->id]) }} method="get">
                                        <input type="hidden" name="type" value="physical">
                                        <button>update</button>
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
{{$p_users->links()}}








@endsection




