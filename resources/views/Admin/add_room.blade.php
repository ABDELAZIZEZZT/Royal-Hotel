@extends('adminlte::page')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
{{-- @dd($reservations); --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.add.room') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>primary photo:</strong>
                            <input type="file" name="p_photo" accept="image/*">
                        <p><strong>the second photo:</strong>
                            <input type="file" name="s_photo" accept="image/*">


                        <p><strong>name:</strong> <input type="text" name="name" value=""></p>

                       <p> <strong>descreptions:</strong> <textarea name="descriptions"></textarea></p>

                        <p><strong>price:</strong><input type="number" name="price" value=""></p>
                        <p><strong>status:</strong>
                        <select name="status">
                            <option value="In use">In use</option>
                            <option value="ready">Ready</option>
                            <option value="It is maintained">It is maintained</option>
                        </select></p>
                        <p><strong>room type:</strong>
                            <select name="room_type">
                            <option value="Premium Double">Premium Double</option>
                            <option value="Silver Double">Silver Double</option>
                            <option value="Premium Single">Premium Single</option>
                            <option value="Standard Double">Standard Double</option>
                            <option value="Standard Single">Standard Single</option>
                            <!-- Add more options as needed -->
                        </select></p>
                        <p><strong>features:</strong><input type="text" name="features" value=""></p>

                         <p><strong>room number:</strong><input type="number" name="room_number" value=""></p>
                         <p><strong>periority:</strong><input type="number" name="periority" value=""></p>
                         <p><strong>number guests:</strong><input type="number" name="num_guests" value=""></p>
                         <p><strong>size:</strong><input type="number" name="size" value=""></p>

                        <button type="submit">Add</button>
                    </form>
                    <h1><a href="/Admin/rooms">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


