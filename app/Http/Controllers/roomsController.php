<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Room_photo;
use Carbon\Carbon;

class roomsController extends Controller
{
    function index(Request $request){
        if($request->method()==="GET"){
            $rooms=Room::orderBy('periority', 'desc')->paginate(20);
            return view('rooms',[
                'rooms'=>$rooms,
                's_check_in'=>null,
                's_check_out'=>null,
                'selected_room'=>null]);
        }else{
            $selected_room=Room::find($request->input('room_id'));

            $reservation=Reservation::find($request->input('reservation_id'));
            $check_in=Carbon::parse($reservation->check_in);
            $timezone = new \DateTimeZone('Egypt');
            $dateTime = new \DateTime('now', $timezone);
            $currentDateTime = $dateTime->format('Y-m-d');
            if($check_in>$currentDateTime){
                // dd($reservation);
               $rooms=Room::orderBy('periority', 'asc')->paginate(5);
               return view('rooms',[
                'rooms'=>$rooms,
                's_check_in'=>$reservation->check_in,
                's_check_out'=>$reservation->check_out,
                'selected_room'=>[$selected_room],
                'reservation_id'=>$reservation->id


            ]);
            }
            else{
                return redirect()->route('user.profile')->with('success','you cant update the check in');
            }
        }
    }
    function room_profile(Request $request){

        if($request->method()==='POST'){
            // dd($request->all());
            $selected_room=Room::where('id',$request->input('id'));

            $id=$request->input('id');

            $room=Room::find($id);
            // dd($request->input('check_in'));
            $reviews=Review::where('room_id',$id)->get();
            $review=0;
            foreach($reviews as $re){
               $review+= $re->rating_on_room;
            }
            if($reviews->count()!=0){
                $room_review=$review/($reviews->count());
                $room_review=round($room_review, 2);
                $room->review=$room_review;
            }else{
                $room->review=0;
            }
            $room->save();
            // dd($id);
            if($request->input('reservervation_id')!=null){

                $reservation=Reservation::find($request->input('reservation_id'));
            }else{
                $reservation=Reservation::where('room_id',$id)->first();
            }

            // dd($reservation);
            if($request->input('check_in')!=null && $request->input('check_out')!=null){
                $check_in=Carbon::parse($request->input('check_in'));
                $check_out=Carbon::parse($request->input('check_out'));
                $deffrant_in_days= $check_out->diffInDays($check_in);
                $total_price=$deffrant_in_days*($room->price);
                $features=Feature::all();
                // dd($check_in);
                return view('room_profile',
                [
                    'features'=>$features,
                    'total_price'=>$total_price,
                    'room'=>$room,
                    'reviews'=>$reviews,
                    'reservation'=>$reservation,
                    'rating'=>$room->review,
                    'check_in'=>$check_in,
                    'check_out'=>$check_out,
                    'selected_room'=>$request->input('id'),


                ]);

            }

            $features=Feature::all();
            // $guest=$request->input('guest');
            return view('room_profile',[
                'features'=>$features,
                'room'=>$room,
                'reviews'=>$reviews,
                'reservation'=>$reservation,
                'rating'=>$room->review,
                'check_in'=>null,
                'check_out'=>null,
                'total_price'=>null,
                'selected_room'=>null,
            ]);
        }else{

            $features=Feature::all();
            $id=$request->input('room_id');

            $room=Room::find($id);
            $reviews=$room->reviews;


            // dd($request->input('check_in'));




            $check_in=Carbon::parse($request->input('check_in'));
            $check_out=Carbon::parse($request->input('check_out'));
            $deffrant_in_days= $check_out->diffInDays($check_in);
            $total_price=$deffrant_in_days*($room->price);
            $features=Feature::all();


            // dd($reservations);
            return view('room_profile',[
                'selected_room'=>null,
                'features'=>$features,
                'room'=>$room,
                'reviews'=>$reviews,
                'reservation'=>null,
                'rating'=>$room->review,
                'check_in'=>$request->input('check_in'),
                'check_out'=>$request->input('check_out'),
                'total_price'=>$total_price
            ]);

        }
    }


    function rooms(Request $request){
        $rooms=Room::paginate(10);
        $found=0;
        if($request->input('room_number')!=null){
            $room_num=$request->input('room_number');
            // dd($request->input('room_number'));
            $room_s=Room::where('room_number', '=', $room_num)->get();
            $found=1;
            return view('Admin.room',['the_room'=>$room_s,'rooms'=>$rooms,'found'=>$found]);
        }else{
            return view('Admin.room',['rooms'=>$rooms,'found'=>$found]);

        }

    }
    // function get_room(Request $request){
    //     $room_num=$request->input('room_number');
    //     $room_s=Room::where('room_number', 'like', "%$room_num%")->get();
    //     if($room_s!=null){
    //         $found="1";
    //     }else{
    //         $found="0";
    //         return view('Admin.room',);
    //     }
    //     return view('Admin.room',['the_room'=>$room_s]);

    // }

    function delet_room($id){

        $room=Room::find($id);
        $reservation=Room::with('reservations')->find($id);
        $reservations=$reservation->reservations;

        if($reservations==[]) {  $reservations->delete();}





        $room->delete();
        return redirect()->route('Admin.rooms')->with('success', 'Item deleted successfully.');

    }
    function update_room($id){

        $room=Room::find($id);
        $reservations=Reservation::where('room_id','=',$id)->get();
        $roomPhotos = $room->Room_photos;
        $roomReview = $room->reviews;


        // dd($roomPhotos);
        return view('Admin.room_profile',['room'=>$room,'reservations'=>$reservations,'roomPhotos'=>$roomPhotos,'roomReview'=>$roomReview]);

    }

    function realy_update_room(Request $request){



        // dd($request->input('p_photo'));
       $id=$_REQUEST['id'];
       $name=$_REQUEST['name'];
       $room_number= $_REQUEST['room_number'];
       $features= $_REQUEST['features'];
       $status= $_REQUEST['status'];
       $price= $_REQUEST['price'];
       $description= $_REQUEST['descriptions'];

       $room=Room::find($id);

       $room->id=$id;
       $room->room_number=$room_number;
       $room->features=$features;
       $room->status=$status;
       $room->price=$price;
       $room->name=$name;
       $room->description=$description;

       $room->save();

        // dd($request->all());
        $this->addORupdate_roomPhoto($request,$room);


        return redirect()->route('update.room',['id'=>$id])->with('success', 'Updated successfully.');


    }
    function add (){
        return view('Admin.add_room');
    }

    function realy_add_room(Request $request){


        // dd($request->all());

        $newData = Room::create([
            'name' => $request->input('name'),
            'description' => $request->input('descriptions'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'features' => $request->input('features'),
            'room_number' => $request->input('room_number'),
            'room_type' => $request->input('room_type'),
            'size' => $request->input('size'),
            'num_guests' => $request->input('num_guests'),
            'periority' => $request->input('periority')
        ]);

        $this->addORupdate_roomPhoto($request,$newData);


        return redirect()->route('admin.add')->with('success', 'Updated successfully.');

    }
   public function addORupdate_roomPhoto(Request $request,$room){
    // dd( $request->input('exist_photo'));


        $request->validate([
            'p_photo' => '|mimes:jpeg,png,jpg,gif|max:2048',
            's_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $_1=0;
        $_2=0;

            if ($request->hasFile('p_photo')) {
                // dd($request);
                $p_photo = $request->file('p_photo');
                $p_filename = time() . '_' . $p_photo->getClientOriginalName();
                $p_photo->storeAs('photos', $p_filename, 'public');
                $_1=1;

                // Update the room photo filename or create a new record
            }

            if ($request->hasFile('s_photo')) {
                $s_photo = $request->file('s_photo');
                $s_filename = time() . '_' . $s_photo->getClientOriginalName();
                $s_photo->storeAs('photos', $s_filename, 'public');
                $_2=1;

                // Update the room photo filename or create a new record
            }
            if($request->input('exist_photo')==null){
            if($_1&&$_2){
                $room->Room_photos()->updateOrCreate([], ['p_photo' => $p_filename,'s_photo' => $s_filename]);
                // $room->Room_photos()->updateOrCreate([], ['s_photo' => $s_filename]);

            }}else{ if($_1||$_2){
                $room->Room_photos()->updateOrCreate([], ['p_photo' => $p_filename,'s_photo' => $s_filename]);
                // $room->Room_photos()->updateOrCreate([], ['s_photo' => $s_filename]);

            }

            }
    }

}
