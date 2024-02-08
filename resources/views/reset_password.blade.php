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
                            <form action={{route('reset.password')}} method="POST">
                                @csrf
                                @method("post")
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>Your Email</label>
                                        <input type="email" name="email" class="form-control" required="required" />
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
