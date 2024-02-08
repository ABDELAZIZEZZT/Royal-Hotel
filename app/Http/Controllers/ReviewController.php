<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;


use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Room;


class ReviewController extends Controller
{
    //
    function reviews(){
        $reviews=Review::paginate(10);

        return view('Admin.reviews',['reviews'=>$reviews]);
    }

    function add_review(Request $request){
        // dd($request->all());
        $room_id=$request->input('room_id');
        $user_id=$request->input('user_id');
        $type=$request->input('type');
        return view('Admin.add_review',['room_id'=>$room_id,'user_id'=>$user_id,'type'=>$type]);

    }
    function realy_add_review(Request $request){
       $request->validate([
        'rating_on_room'=>'required|numeric|between:0,5',
        'rating_overall'=>'required|numeric|between:0,5'
       ]);
       if($request->user_type=='physical'){
           $newData = Review::create([
               'user_p_id' => $request->input('user_id'),
               'room_id' => $request->input('room_id'),
               'comment' => $request->input('comment'),
               'user_type' => $request->input('user_type'),
               'rating_overall' => $request->input('rating_overall'),
               'rating_on_room' => $request->input('rating_on_room'),
           ]);
       }else{
        $newData = Review::create([
            'user_id' => $request->input('user_id'),
            'room_id' => $request->input('room_id'),
            'comment' => $request->input('comment'),
            'user_type' => $request->input('user_type'),
            'rating_overall' => $request->input('rating_overall'),
            'rating_on_room' => $request->input('rating_on_room'),
        ]);

       }
        return redirect()->route('reservation')->with('success', 'the review is add .');
    }

    function index(Request $request){

        try {
            $validatedData = $request->validate([
                'comment' => 'required',
                'rating' => 'required|numeric|between:0,5'
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('room.profile',['id'=>$request->input('room_id')])->with('error','not valid rate');
        }
        $newData = Review::create([
            'user_id' => auth()->user()->id,
            'room_id' => $request->input('room_id'),
            'comment' => $request->input('comment'),
            'rating_on_room' => $request->input('rating'),
        ]);
        $id=$request->input('room_id');
        $room=Room::find($id);
        $reviews=Review::where('room_id',$id)->get();
        $review=0;
        foreach($reviews as $re){
           $review+= $re->rating_on_room;
        }
        if($reviews->count()!=0){
            $room_review=$review/($reviews->count());
            $room->review=$room_review;
        }else{
            $room->review=0;
        }

        return redirect()->route('room.profile',[
            'id'=>$request->input('room_id'),
            'selected_room'=>null,
            'reservation'=>null,

        ]);

    }
    function user_delete_review(Request $request ){
        $id=$request->input('review_id');
        $review=Review::find($id);
        $review->delete();
        return redirect()->route('room.profile',['id'=>$request->input('room_id'), 'selected_room'=>null,]);
    }

    function user_update_review(Request $request){
        $review=Review::find($request->input('review_id'));
        $review->comment=$request->input('comment');
        $review->rating_on_room=$request->input('rating_on_room');
        $review->save();

        return redirect()->route('room.profile',['id'=>$request->input('room_id'),'selected_room'=>null,]);

    }
}
