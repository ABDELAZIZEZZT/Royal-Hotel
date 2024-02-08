@extends('adminlte::page');
@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<h1>Room Profile</h1>
<form action="{{ route('realy.update.room', ['id' => $room->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($roomPhotos != null)
        @foreach ($roomPhotos as $photo)
            <img src="{{ asset('storage/photos/' . $photo->p_photo) }}" alt="Primary Photo">
            <img src="{{ asset('storage/photos/' . $photo->s_photo) }}" alt="Secondary Photo">
            <input type="hidden" name="exist_photo" value="1"></p>
        @endforeach
    @endif

    <!-- Add your other form fields and submit button here -->


 <strong>primary photo:</strong>
    <input type="file" name="p_photo" accept="image/*">
<strong>the second photo:</strong>
    <input type="file" name="s_photo" accept="image/*">

<p><strong>ID:</strong>

<input type="text" name="id" value="{{$room->id}}"></p>

<p><strong>name:</strong> <input type="text" name="name" value="{{$room->name}}"></p>

<p><strong>descreptions:</strong> <input type="text" name="descriptions" value="{{$room->description}}"></p>

<p><strong>price:</strong><input type="text" name="price" value="{{$room->price}}"></p>
<p><strong>descounts:</strong><input type="text" name="discounts" value="{{$room->discount_id}}"></p>
<p><strong>periority:</strong><input type="text" name="periority" value="{{$room->periority}}"></p>

<p><strong>status:</strong><p>{{$room->status}}</p>
<p><strong>status:</strong>
    <select name="status">
        <option value="In use">In use</option>
        <option value="ready">Ready</option>
        <option value="It is maintained">It is maintained</option>
</select></p>

<p><strong>room type:</strong><p>{{$room->room_type}}</p>
<select name="room_type">
    <option value="Premium Double">Premium Double</option>
    <option value="Silver Double">Silver Double</option>
    <option value="Premium Single">Premium Single</option>
    <option value="Standard Double">Standard Double</option>
    <option value="Standard Single">Standard Single</option>
</select></p>



<p><strong>features:</strong><input type="text" name="features" value="{{$room->features}}"></p>

 <p><strong>room number:</strong><input type="text" name="room_number" value="{{$room->room_number}}"></p>

<button>update</button>
</form>
<h1>Room Resaervations</h1><h3>for view</h3>
@if (count($reservations)==0)
<p>no reservation for this room</p>
@else
@foreach ($reservations as $reservation )
<p>id={{$reservation->id}}</p>
@if ($reservation->user_type=='physical')
<p>user id={{$reservation->user_p_id}}</p>
@else
<p>user id={{$reservation->user_id}}</p>
@endif
<p>room_id={{$reservation->room_id}}</p>
<p>check in date={{$reservation->check_in}}</p>
<p>check out date={{$reservation->check_out}}</p>
<p>the numper of guests={{$reservation->number_of_guests}}</p>
<p>the total price={{$reservation->price}}</p>
<p>////////////////</p>
@endforeach


@endif

<h1>Room reviews</h1><h3>for review</h3>
@if (count($roomReview)==0)
<p>no reviews for this room</p>
@else
@foreach ($roomReview as $review )

<p>id={{$review->id}}</p>
<p>user id={{$review->user_id}}</p>
<p>room id={{$review->room_id}}</p>
<p>rating on room={{$review->rating_on_room}}</p>
<p>rating overall={{$review->rating_overall	}}</p>
<p>comment={{$review->comment}}</p>
<p>////////////////</p>
@endforeach

@endif

<h1><a href="/Admin/rooms">return</a></h1>





@endsection


