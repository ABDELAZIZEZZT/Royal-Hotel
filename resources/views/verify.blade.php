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
                    <h2>reset your password</h2>

                </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <form method="post" action={{route('verify')}}>
                                @csrf
                                @method("post")
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>token</label>
                                        <input type="text" name="token" class="form-control" required="required" />
                                    </div>
                                </div>
                                <div class="button"><button type="submit">submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    </html>
@endsection
