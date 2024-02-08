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


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.add.review') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>user_id</strong> <input type="text" name="user_id" value={{$user_id}}></p>
                        <p><strong>room number</strong> <input type="id" name="room_id" value={{$room_id}}></p>
                        <p><strong>review on room</strong> <input type="number" name="rating_on_room" value=""></p>
                        <p><strong>review over all</strong> <input type="number" name="rating_overall" value=""></p>
                        <p><strong>comment</strong> <input type="text" name="comment" value=""></p>
                        <input type="hidden" name="user_type" value="physical"></p>
                        <button type="submit">add</button>
                    </form>
                    <h1><a href="/Admin/reservation">return</a></h1>
            </div>
        </div>
    </div>
</div>






@endsection


