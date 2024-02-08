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
                    <form action={{route('realy.update.slide',['id'=>$slide->id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>photo:</strong>
                                    <img src="{{asset('storage/photos/sliders/' . $slide->photo)}}" alt="Primary Photo">
                            <input type="file" name="photo" accept="image/*">
                        </p>

                       <p> <strong>name:</strong> <textarea name="name">{{$slide->name}}</textarea></p>

                        <p><strong>piriority:</strong><input type="text" name="priority" value={{$slide->periorty}}></p>



                        <button type="submit">update</button>
                    </form>
                    <h1><a href="/Admin">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


