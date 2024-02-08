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
@endif
<h5><a href="/Admin/add_p_user">add user</a></h5>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.add.reservation') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>user id:</strong> <input type="text" name="user_id" value=""></p>

                        <p><strong>number of guests</strong><input type="number" name="number_of_guests" value=""></p>
                        {{-- <p><strong>room id:</strong><input type="text" name="room_id" value=""></p> --}}
                        <p><strong>room type:</strong>
                            <select name="room_type">
                            <option value="Premium Double">Premium Double</option>
                            <option value="Silver Double">Silver Double</option>
                            <option value="Premium Single">Premium Single</option>
                            <option value="Standard Double">Standard Double</option>
                            <option value="Standard Single">Standard Single</option>
                        </select></p>
                        <label for="reservation_start_time">Reservation Start Time:</label>
                        <input type="datetime-local" name="check_in" required>
                        <br>
                        <label for="reservation_end_time">Reservation End Time:</label>
                        <input type="datetime-local" name="check_out" required>


                        @foreach ($features as $feature )
                            <div class="form-row">
                                <div class="control-group col-md-6">
                                    <label>{{$feature->feature}} {{$feature->price}}$ for 1 guest</label>
                                    <input type="checkbox" id="checkboxId" name="feature[]" value="{{$feature->feature}}">
                                </div>
                            </div>
                        @endforeach

                        <button type="submit">Add</button>
                    </form>
                    <h1><a href="/Admin/reservation">return</a></h1>
            </div>
        </div>
    </div>
</div>






@endsection


