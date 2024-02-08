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
</div>

{{-- @dd($reservations); --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.add.about') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>photo:</strong>
                            <input type="file" name="photo" accept="image/*">
                        </p>

                       <p> <strong>descreptions:</strong> <textarea name="descriptions"></textarea></p>

                        <p><strong>headline:</strong><input type="text" name="head_line" value=""></p>

                        <p><strong>URL for button</strong><input type="text" name="path" value=""></p>

                        <button type="submit">Add</button>
                    </form>
                    <h1><a href="/Admin/about">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


