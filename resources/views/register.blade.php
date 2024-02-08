
@extends('layouts')
<!DOCTYPE html>
<html lang="en">
    @section('titel','register')
@section('content')
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="login-form">
                <form method="post" action="{{route('register')}}">
                    @csrf
                    @method('post')
                    <div class="form-row">
                        <div class="control-group col-sm-6">
                            <label>Your Name</label>
                            <input type="text" name="name" class="form-control" required="required" />
                        </div>
                        <div class="control-group col-sm-6">
                            <label>Your address</label>
                            <input type="text" name="address" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="control-group col-sm-6">
                            <label>email </label>
                            <input type="email" name="email" class="form-control" required="required" />
                        </div>
                        <div class="control-group col-sm-6">
                            <label>Your phone number</label>
                            <input type="tel" name="phone_number" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="control-group col-sm-6">
                            <label>Your Password</label>
                            <input type="password" name="password" class="form-control" required="required" />
                        </div>
                        <div class="control-group col-sm-6">
                            <label>Repeat Your Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="button"><button type="submit">Register</button></div>
                </form>
            </div>
        </div>
</body>
@endsection
