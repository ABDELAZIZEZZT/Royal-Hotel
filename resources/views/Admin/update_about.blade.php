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
                    <form action={{route('realy.update.about',['id'=>$id]) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p><strong>photo:</strong>
                            @if ($about->photo != null)
                                    <img src="{{ asset('storage/photos/' . $about->photo) }}" alt="Primary Photo">

                            @endif
                            <input type="file" name="photo" accept="image/*">
                        </p>

                       <p> <strong>descreptions:</strong> <textarea name="description">{{$about->description}}</textarea></p>

                        <p><strong>headline:</strong><input type="text" name="head_line" value={{$about->head_line}}></p>

                        <p><strong>URL for button</strong><input type="text" name="path" value={{$about->path}}></p>

                        <button type="submit">update</button>
                    </form>
                    <h1><a href="/Admin/about">return</a></h1>
            </div>
        </div>
    </div>
</div>



@endsection


