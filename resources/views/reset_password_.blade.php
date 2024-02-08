@extends('layouts')
<!DOCTYPE html>
<html lang="en">
    @section('titel','Login')
@section('content')

    <body>
        <div id="login">
            <div class="container">
                <div class="section-header">
                    <h2>reset your password</h2>

                </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <form action={{route('reset.password.realy')}} method="POST">
                                @csrf
                                @method("POST")
                                <div class="form-row">
                                    <label>Your emaile</label>
                                        <input type="email" name="email" value="{{$email}}" class="form-control" required="required" />
                                    <div class="control-group col-sm-6">
                                        <label>Your Password</label>
                                        <input type="password" name="password" class="form-control" required="required" />
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>Repeat Your Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required="required" />
                                    </div>
                                </div>
                                <div class="button"><button type="submit">reset</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    </html>
@endsection
