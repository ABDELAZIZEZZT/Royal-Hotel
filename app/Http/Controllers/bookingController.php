<?php

namespace App\Http\Controllers;

use App\Mail\check_in;
use App\Models\Feature;
use App\Models\Reservation;
use App\Models\ReservationFeature;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class bookingController extends Controller
{
    function index(Request $request){

        if($request->input('check_in')==null){
            return redirect()->route('rooms')->with('success','please select your check in and check out');
        }
        $features=$request->input('feature');
        $total_price=$request->input('total_price');
        $total_price_f=$total_price;
        if($features!=null){
            foreach ($features as $feature){
                $price=Feature::where('feature',$feature)->first()->price;
                $total_price_f+=($price*($request->input('num_guests')));
            }
        }
        // dd($request->all());

        return view('booking',[
            'check_in'=>$request->input('check_in'),
            'check_out'=>$request->input('check_out'),
            'room_id'=>$request->input('room_id'),
            'room_number'=>$request->input('room_number'),
            'num_guests'=>$request->input('num_guests'),
            'price'=>$request->input('price'),
            'features'=>$request->input('feature'),
            'total_price'=>$total_price,
            'total_price_f'=>$total_price_f,
            'id'=>$request->input('id')
        ]);
    }
    function check_booking(Request $request){
        // dd($request->all());
        $room_id=$request->input('room_id');
        $number_of_guests=$request->input('num_guest');
        // dd($room_id);
        $t_price=$request->input('price');
        $room_number=$request->input('room_number');

        $features=$request->input('features');
        // dd($features);
        $feature_id=[];
        if($features!=null){
            foreach($features as $feature){
                $id=Feature::where('feature',$feature)->first()->id;
               array_push($feature_id,$id);
            }
        }




        // dd($price);
        $user_type="web";
        // dd($request->all());
        if($request->input('id')!=null){
            $reservation=Reservation::find($id);
            // dd($reservation);
            $reservation->user_id=auth()->user()->id;
            $reservation->room_id=$room_id;
            $reservation->check_in=$request->input('check_in');
            $reservation->check_out=$request->input('check_out');
            $reservation->number_of_guests=$number_of_guests;
            $reservation->price=$t_price;
            $reservation->user_type=$user_type;
            $reservation->save();
        }else{
            $reservation=Reservation::create([
                'user_id'=>auth()->user()->id,
                'room_id'=>$room_id,
                'check_in'=>$request->input('check_in'),
                'check_out'=>$request->input('check_out'),
                'number_of_guests'=>$number_of_guests,
                'price'=>$t_price,
                'user_type'=>$user_type,
            ]);
        }

        if($features!=null){
            $reservation->features()->attach($feature_id);
        }
        $room=Room::find($room_id);
        $room->status='in use';
        $room->save();

        $user=User::find(auth()->user()->id);
        $user->check_in='1';
        $user->save();

        $email=auth()->user()->email;
        $room_number=$request->input('room_number');


        $this->send_email($email,$room_number);

        return redirect()->route('rooms')->with('success', 'reservation is done teh room number :'.$room_number);

    }
    function send_email ($email,$room_number){

        Mail::to('zezo@email.com')->send(new check_in($room_number));
    }
    // function update_view($id){

    //     $reservation = Reservation::find($id);
    //     $all_features=Feature::all();
    //     return view('update_reservation',['reservation'=>$reservation,'features'=>$reservation->features,'all_features'=>$all_features]);

    // }
}
