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


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                    <form action={{route('realy.update.feature') }} method="POST">
                        @csrf
                        @method('PUT')


                       <p><strong>feature:</strong><input type="text" name="feature" value="{{$feature->feature}}"></p>
                      <input type="hidden" name="id" value="{{$feature->id}}"></p>

                        <p><strong>price for one guest:</strong><input type="number" name="price" value="{{$feature->price}}"></p>



                        <button type="submit">update</button>
                    </form>
                    <h1><a href="/Admin/features">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


