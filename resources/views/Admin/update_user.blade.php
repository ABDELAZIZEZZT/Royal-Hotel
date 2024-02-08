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


{{-- @dd($admin); --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('Realyupdate.user',['id'=>$user->id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><strong>name:</strong><input type="text" name="name" value={{$user->name}}></p>

                        <p><strong>email</strong><input type="email" name="email" value={{$user->email}}></p>
                        <p><strong>password</strong><input type="text" name="password" value={{$user->password}}></p>
                        <p><strong>address</strong><input type="text" name="address" value={{$user->address}}></p>
                        <p><strong>phone number</strong><input type="text" name="phone_number" value={{$user->phone_number}}></p>
                        <p><strong>checked in:</strong><input type="checkbox" name="check_in" value={{$user->check_in ? 'checked' : '0' }}></p>
                        <p><strong>checked out:</strong><input type="checkbox" name="check_out" value={{$user->check_out ? 'checked' : '0' }}></p>

                        <button type="submit">update</button>
                    </form>
                    <h1><a href="/Admin/users">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


