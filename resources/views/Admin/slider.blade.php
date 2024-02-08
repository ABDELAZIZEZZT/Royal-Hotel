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


<form action="{{ route('add.slider') }}" method="post" enctype="multipart/form-data">
    @csrf
    <p><strong>Primary photo:</strong>
        <input type="file" name="photo">
    </p>
    <p><strong>Name:</strong> <input type="text" name="name" value=""></p>
    <p><strong>Priority:</strong><input type="number" name="priority" value=""></p>
    <button type="submit">Add</button>
</form>
{{-- <form action="" method="GET">
    <button>add new photo</button>
</form> --}}

   </div>

@endsection





