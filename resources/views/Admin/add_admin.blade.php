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

{{-- @dd($reservations); --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.add.admin') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>name:</strong> <input type="text" name="name" value=""></p>

                        <p><strong>email:</strong><input type="email" name="email" value=""></p>

                       <p> <strong>password:</strong><input type="password" name="password" value=""></p>

                        <p><strong>address</strong><input type="text" name="address" value=""></p>
                        <p><strong>role:</strong>
                        <select name="role">
                            <option value="admin">admin</option>
                            <option value="owner">owner</option>
                        </select></p>

                        <p><strong>phone number:</strong><input type="text" name="phone_number" value=""></p>


                        <button type="submit">Add</button>
                    </form>
                    <h1><a href="/Admin/admins">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


