@extends('layouts')
<!DOCTYPE html>
<html lang="en">
    @section('titel','Login')
@section('content')
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('success') }}
</div>
@endif
    <body>
        <div id="login">
            <div class="container">
                <div class="section-header">
                    <h2>Login</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis, enim at venenatis tincidunt.
                    </p>
                </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <form action={{route('login')}} method="post">
                                @csrf
                                @method("POST")
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>Your Email</label>
                                        <input type="email" name="email" class="form-control" required="required" />
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>Your Password</label>
                                        <input type="password" name="password" class="form-control" required="required" />
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="button"><button type="submit">Login</button></div>
                            </form>
                            <p>reset password</p>
                           <a href="/reset/view">reset password</a>
                            <p>if it's your firt time please register</p>
                            <form action="{{route('register.view')}}" method="get">
                                <button>Register</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Section End -->

    </body>
    </html>
@endsection
