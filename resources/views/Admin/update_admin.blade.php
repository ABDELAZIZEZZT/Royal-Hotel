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
                    <form action={{route('Realyupdate.admin',['id'=>$admin->id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><strong>name:</strong><input type="text" name="name" value={{$admin->name}}></p>

                        <p><strong>email</strong><input type="email" name="email" value={{$admin->email}}></p>
                        <p><strong>password</strong><input type="text" name="password" value={{$admin->password}}></p>
                        <p><strong>address</strong><input type="text" name="address" value={{$admin->address}}></p>
                        <p><strong>phone number</strong><input type="text" name="phone_number" value={{$admin->phone_number}}></p>
                        <p><strong>role</strong>
                            <select name="role">
                            <option value="owner">owner</option>
                            <option value="admin">admin</option>
                        </select></p>

                        <button type="submit">update</button>
                    </form>
                    <h1><a href="/Admin/admin">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


