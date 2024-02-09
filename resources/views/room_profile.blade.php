
@extends('layouts')
<!DOCTYPE html>
<html lang="en">
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
</div>
@endif
@section('titel','profile')
@section('content')


<body>
<div class="container">
    <div class="row">
        <div class="col-20">
            <div class="card card-lg">
                <h6 class="card-header">
                    {{$room->name}}
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <div id="imageSlider" class="carousel slide" data-ride="carousel" style="width: 90%; max-width: 600px;"> <!-- Adjust max-width as needed -->
                                        <div class="carousel-inner">

                                            {{$hasPhoto = count($room->Room_photos)}}
                                            @if ($hasPhoto)
                                            <div class="carousel-item active">
                                                <img src="{{asset('storage/photos/' .$room->Room_photos[0]->p_photo)}}" class="d-block w-100" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('storage/photos/' .$room->Room_photos[0]->s_photo)}}" class="d-block w-100" alt="Second slide">
                                            </div>
                                            @else
                                            <img src="{{asset('storage/photos/1707136813_room-4.jpg')}}">
                                            @endif

                                            <!-- Add more items as needed -->
                                        </div>
                                        <!-- Add previous and next buttons if desired -->
                                        <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-md-40">
                                        <div class="box">
                                            <div class="box-body">
                                                <p><strong>name : </strong>{{$room->name}}</p>
                                                <p><strong>type : </strong>{{$room->room_type}}</p>
                                                <p><strong>up to : </strong>{{$room->num_guests}} guests</p>
                                                <p><strong>size : </strong>{{$room->size}} m^2</p>
                                                <p><strong>price : </strong>{{$room->price}}</p>
                                                <p><strong>description : </strong>{{$room->description}}</p>
                                                <p><strong>rating : </strong>{{$room->review}}/5 from {{$reviews->count()}} users </p>

                                                <form action={{route('booking.view')}} method="post">

                                                    @csrf
                                                    @method("POST")
                                                    @foreach ($features as $feature )

                                                    <div class="form-row">
                                                        <div class="control-group col-md-6">
                                                            <label>{{$feature->feature}} {{$feature->price}}$ for 1 guest</label>
                                                            <input type="checkbox" id="checkboxId" name="feature[]" value="{{$feature->feature}}">
                                                        </div>
                                                    </div>

                                                    @endforeach


                                                    <input type="hidden" name="check_in" value="{{$check_in}}">
                                                    <input type="hidden" name="check_out" value="{{$check_out}}">
                                                    <input type="hidden" name="room_id" value="{{$room->id}}">
                                                    <input type="hidden" name="room_number" value="{{$room->room_number}}">
                                                    <input type="hidden" name="num_guests" value="{{$room->num_guests}}">
                                                    <input type="hidden" name="price" value="{{$room->price}}">
                                                    <input type="hidden" name="total_price" value="{{$total_price}}">
                                                    <input type="hidden" name="selected_room" value="{{$selected_room}}">

                                                    @if ($reservation!=null)
                                                     <input type="hidden" name="id" value="{{$reservation->id}}">

                                                    @endif






                                                    <button type="submit">Book now</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>add comment and rating from 5</h5>
                        @if(Auth::check() && Auth::user()->role === 'user')

                            <form action="{{route('add.review')}}" method="get">
                          

                            <input type="hidden" name="room_id" value={{$room->id}}>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="comment" class="form-control" placeholder="add your comment">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" name="rating" class="form-control" placeholder="rate from 5">
                                        </div>
                                           <button class="btn btn-xs btn-primary ml-10 w-sm-100p">add</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                            <h5>user reviews</h5>
                        @if (count($reviews)==0)
                            <p>no reviews for this room</p>
                        @else
                           <div class="row">
                               <div class="col-md-80">
                                   <div class="box">
                                       <div class="box-body">
                                           <table class="table">
                                               <thead>
                                                   <tr>
                                                       <th>user</th>
                                                       <th>room review</th>
                                                       <th>comment</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   @foreach($reviews as $review)
                                                       <tr>
                                                           <td>{{$review->user->name}}</td>
                                                            @if (Auth::check() && auth()->user()->id==$review->user_id)
                                                            <form action={{route("user.update.review")}} method="post">
                                                                @csrf
                                                                @method("put")
                                                                <td><input type="text" name="rating_on_room" value="{{$review->rating_on_room}}" ></td>
                                                                <td><input type="text" name="comment" value="{{$review->comment}}" ></td>
                                                                <input type="hidden" value="{{$review->id}}" name="review_id">
                                                                <input type="hidden" value="{{$room->id}}" name="room_id">
                                                                <td><button>update</button></td>
                                                            </form>
                                                                <td>
                                                                    <form action={{route("user.delete.review")}} method="post">

                                                                        @csrf
                                                                        @method("delete")
                                                                        <input type="hidden" value="{{$review->id}}" name="review_id">
                                                                        <input type="hidden" value="{{$room->id}}" name="room_id">
                                                                        <button>delete</button>
                                                                    </form>
                                                                </td>
                                                            @else
                                                           <td>{{ $review->rating_on_room }}</td>
                                                           <td>{{ $review->comment }}</td>
                                                           @endif
                                                       </tr>
                                                   @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection

