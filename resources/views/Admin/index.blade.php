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

<div id="headerSlider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($slides as $index => $slide)
            <li data-target="#headerSlider" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($slides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{asset('storage/photos/sliders/' . $slide['photo'])}}" alt="Slide {{ $index + 1 }}">
                <div class="carousel-caption">
                    <h1 class="animated fadeInRight">{{ $slide['name'] }}</h1>
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><hr>
<hr><hr><hr><hr><hr><hr>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>priority</th>
                <th>delete</th>
                <th>update</th>



                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            {{-- @dd($slides); --}}
            @foreach($slides as $index=>$slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name}}</td>
                    <td>{{ $slider->periorty}}</td>
                    <td>
                        <form action={{ route('delete.slider', ['id'=>$slider->id]) }} method="post">
                            @csrf
                            @method('DELETE')
                            <button>delet</button>
                        </form>
                    </td>
                    <td>
                        <form action={{ route('update.slider', ['id'=>$slider->id]) }} method="post">
                            @csrf
                            <button>update</button>
                        </form>
                    </td>
                    <!-- Add more columns as needed -->
                </tr>
                @endforeach
            </tbody>
    </table>

</div>
<div>

    <form action={{ route('slider') }} method="get">

        <button>add</button>
    </form>

</div>






@endsection






