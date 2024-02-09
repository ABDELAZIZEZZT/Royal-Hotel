<?php

namespace App\Http\Controllers;

use App\Mail\review;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use App\Models\Physical_user;
use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Models\Feature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    //
    function reservation(Request $request){
        $reservation=Reservation::paginate(10);
        $found=0;
        if($request->input('id')!=null){
            $reservation_id=$request->input('id');
            $reservation_s=Reservation::where('id','=',$reservation_id)->get();
            // dd($reservation_s);
           if($reservation_s!=null) $found=1;
            return view('Admin.reservation',['reservations'=>$reservation,'the_reservation'=>$reservation_s,'found'=>$found]);
        }elseif($request->input('room_number')!=null){
            $room_number=$request->input('room_number');
            $room=Room::where('room_number','=',$room_number)->get();
            // dd($room);
            foreach($room as $r){
                $room_id=$r->id;

            }
            // dd($room_id);
            $reservation_s=Reservation::where('room_id','=',$room_id)->orderBy('check_in', 'desc')->get();
            // dd($reservation_s);
           if($reservation_s!=null) $found=1;

            return view('Admin.reservation',['reservations'=>$reservation,'the_reservation'=>$reservation_s,'found'=>$found]);

        }else{
            if($request->input('check_out')!=null){
                $reservation_checkout=$request->input('check_out');
                $carbonDate = Carbon::parse($reservation_checkout);
                $outputDate = $carbonDate->format('Y-m-d');
                $reservation_s=Reservation::where('check_out','like','%'.$outputDate.'%')->where('status','!=','expired')->get();

                // dd($reservation_s);
               if($reservation_s!=null) $found=1;
                return view('Admin.reservation',['reservations'=>$reservation,'the_reservation'=>$reservation_s,'found'=>$found]);
            }

            return view('Admin.reservation',['reservations'=>$reservation,'found'=>$found]);

        }


    }
    function add_reservation(){
        $features=Feature::all();
        return view('Admin.add_reservation',['features'=>$features]);

    }
    function Realyadd_reservation(Request $request){
        $id=$request->input('id');
        $number_of_guests=$request->input('number_of_guests');
        $room_type=$request->input('room_type');
        $user_id=$request->input('user_id');
        $user=Physical_user::find($user_id);
        $check_in=Carbon::parse($request->input('check_in'));
        $check_out=Carbon::parse($request->input('check_out'));
        $deffrant_in_days= $check_out->diffInDays($check_in);
        $timezone = new \DateTimeZone('Egypt');
        $dateTime = new \DateTime('now', $timezone);
        $currentDateTime = $dateTime->format('Y-m-d');
        if($user==null){
            return redirect()->route('add.reservation')->with('success', 'not valid user_id');
        }
        // dd($check_in->format('Y-m-d'));
        if($check_in->format('Y-m-d')<$currentDateTime){
            return redirect()->route('add.reservation')->with('success', 'not valid check in date');
        }
        if($check_out<$currentDateTime){
            return redirect()->route('add.reservation')->with('success', 'not valid check out date');
        }
        if($check_out<=$check_in){
            return redirect()->route('add.reservation')->with('success', 'not valid date ');
        }
        $rooms=Room::where('room_type','=',$room_type)->where('status','=','ready')->get();

        if($rooms==null){
            return redirect()->route('add.reservation')->with('success', 'no rooms avilabale');
        }
        $selected_room=$rooms->first();
        // dd($rooms);
        foreach($rooms as $room){
           $id=$room->id;
           $reservations=Reservation::where('room_id','=',$id)->where('status','!=','expierd');
           if($reservations==null){$selected_room=$room; break;}
           foreach($reservations as $reservation){
            if($reservation->check_in > $check_out){$selected_room=$room; break;}
           }
           if($selected_room!=null)break;
        }
        // dd($selected_room);
        if($selected_room==null){
            return redirect()->route('add.reservation')->with('success', 'no rooms avilabale');
        }
        $room_id=$selected_room->id;
        // dd($room_id);
        $price=$selected_room->price;
        $room_number=$selected_room->room_number;
        $room_des=$selected_room->description;
        $deffrant_in_days= $check_out->diffInDays($check_in);
        $total_price=$deffrant_in_days*$price;
        // dd($price);
        $user_type="physical";
        $features=$request->input('feature');
        if($features!=null){
            $feature_id=[];
            foreach($features as $feature){
                $id=Feature::where('feature',$feature)->first()->id;
               array_push($feature_id,$id);
            }
            foreach ($features as $feature){
                $price=Feature::where('feature',$feature)->first()->price;
                $total_price+=($price*($request->input('number_of_guests')));
            }
        }

        $reservation=Reservation::create([
            'user_p_id'=>$user_id,
            'room_id'=>$room_id,
            'check_in'=>$request->input('check_in'),
            'check_out'=>$request->input('check_out'),
            'number_of_guests'=>$number_of_guests,
            'price'=>$total_price,
            'user_type'=>$user_type,
        ]);
        if($features!=null){
            $reservation->features()->attach($feature_id);
        }



        return redirect()->route('reservation')->with('success', 'reservation is done teh room number :'.$room_number);
    }
    function update_reservation($id){
        $reservation=Reservation::find($id);

        if($reservation->status=='expierd'){
            return redirect()->route('reservation')->with('success', 'reservation is expierd you cant update it make new one');
        }
        if($reservation->status=='started'){
            return redirect()->route('reservation')->with('success', 'reservation is started you cant update it make new one');
        }
        $reservation_f = Reservation::with('features')->find($id);
        $features=Feature::all();
        $selected_feature=$reservation_f->features;
        // dd($selected_feature);
        $room=Room::find($reservation->room_id);
        return view('Admin.update_reservation',[
            'reservation'=>$reservation,
            'room'=>$room,
            'features'=>$features,
            'selected_feature'=>$selected_feature,
        ]);

    }
    function Realyupdate_reservation(Request $request ,$id){

        $number_of_guests=$request->input('number_of_guests');
        $room_type=$request->input('room_type');
        $user_id=$request->input('user_id');
        $room_id=$request->input('room_id');
        $check_in=Carbon::parse($request->input('check_in'));
        $check_out=Carbon::parse($request->input('check_out'));
        $user_type=$request->input('user_type');
        $timezone = new \DateTimeZone('Egypt');
        $dateTime = new \DateTime('now', $timezone);
        $currentDateTime = $dateTime->format('Y-m-d');
        if($check_in->format('Y-m-d')<$currentDateTime){
            return redirect()->route('add.reservation')->with('success', 'not valid check in date');
        }
        if($check_out<$currentDateTime){
            return redirect()->route('add.reservation')->with('success', 'not valid check out date');
        }
        if($check_out<=$check_in){
            return redirect()->route('add.reservation')->with('success', 'not valid date ');
        }
        $rooms=Room::where('room_type','=',$room_type)->where('status','=','ready')->get();
        // dd($rooms);
        if(count($rooms)==0){
            return redirect()->route('reservation')->with('success', 'no rooms avilabale');
        }
        $selected_room=$rooms->first();
        // dd($rooms);
        foreach($rooms as $room){
           $id=$room->id;
           $reservations=Reservation::where('room_id','=',$id)->where('status','!=','expierd');
           if($reservations==null){$selected_room=$room; break;}
           foreach($reservations as $reservation){
            if($reservation->check_in > $check_out){$selected_room=$room; break;}
           }
           if($selected_room!=null)break;
        }
        $room_id=$selected_room->id;
        $price=$selected_room->price;
        $room_number=$selected_room->room_number;
        $room_des=$selected_room->description;
        $deffrant_in_days= $check_out->diffInDays($check_in);
        $total_price=$deffrant_in_days*$price;

        $thefirst_room=Room::find($room_id);
        $thefirst_room->status='ready';
        $thefirst_room->save();

        $reservation=Reservation::find($request->input('id'));
        // dd($request->all());
        if($user_type=='physical')
        $reservation->user_p_id=$user_id;
        else
        $reservation->user_id=$user_id;
        $reservation->room_id=$room_id;
        $reservation->check_in=$request->input('check_in');
        $reservation->check_out=$request->input('check_out');
        $reservation->number_of_guests=$number_of_guests;
        $reservation->price=$total_price;
        $reservation->save();
        $selected_room->status='in use';
        $selected_room->save();

        return redirect()->route('reservation')->with('success', 'reservation is updated room number'.$room_number.'the reservation id='.$id);

    }
    function delete_reservation($id){
        $reservation=Reservation::find($id);

        if($reservation->status=='started'||$reservation->status==''){
            return redirect()->route('reservation')->with('success', 'reservation is started you cant delete it');
        }

        $reservation->features()->detach();

        $reservation->delete();
        return redirect()->route('reservation')->with('success', 'reservation is deleted');

    }
    function check_out(Request $request){

        $reservation=Reservation::find($request->input('id'));
        if($reservation->status=='expierd')
         {
            return redirect()->route('reservation')->with('success', 'reservation is expierd');
        }
        $reservation->status='expierd';
        $reservation->save();
        // dd( $this->send_email());
        if($request->input('user_type')=='physical'){
            $user=Physical_user::find($request->input('user_id'));
            $user->check_out='0';
            $user->check_in='0';
            $user->save();


        }else{
            $user=User::find($request->input('user_id'));
            $user->check_out='0';
            $user->check_in='0';
            $user->save();
            $this->send_email($user->email);

        }
        $room=Room::find($request->room_id);
        $room->status='ready';
        $room->save();

        return redirect()->route('reservation')->with('success', 'reservation is expierd');


    }
    function check_in(Request $request){

        $reservation=Reservation::find($request->input('id'));
        if($reservation->status=='expierd')
         {
            return redirect()->route('reservation')->with('success', 'reservation is expierd');
        }
        if($reservation->status=='started')
        {
           return redirect()->route('reservation')->with('success', 'reservation is started');
       }
        $reservation->status='started';
        $reservation->save();
        // dd($request->input('user_type') );
        if($request->input('user_type')=='physical'){
            $user=Physical_user::find($request->input('user_id'));
            $user->check_in='1';
            $user->check_in='0';
            $user->save();


        }else{
            $user=User::find($request->input('user_id'));
            $user->check_out='1';
            $user->check_in='0';
            $user->save();

        }
        $room=Room::find($request->room_id);
        $room->status='inuse';
        $room->save();

        return redirect()->route('reservation')->with('success', 'reservation is started');


    }
    function send_email ($email){
        Mail::to('zezo@email.com')->send(new review());
    }

    function get_room(Request $request){
        if($request->method()==='PUT'){
            // dd($request->all());
            $id=$request->input('id');
            $number_of_guests=$request->input('guest');

            $check_in=Carbon::parse($request->input('check_in'));
            $check_out=Carbon::parse($request->input('check_out'));

            $deffrant_in_days= $check_out->diffInDays($check_in);

            $timezone = new \DateTimeZone('Egypt');
            $dateTime = new \DateTime('now', $timezone);
            $currentDateTime = $dateTime->format('Y-m-d');
            // dd($check_in->format('Y-m-d'));
            if($check_in->format('Y-m-d')<$currentDateTime||$check_in==null){
                return redirect()->route('rooms')->with('success', 'not valid check in date');
            }
            if($check_out<$currentDateTime||$check_out==null){
                return redirect()->route('rooms')->with('success', 'not valid check out date');
            }
            if($check_out<=$check_in){
                return redirect()->route('rooms')->with('success', 'not valid date ');
            }
            $rooms=Room::where('num_guests','=',$request->input('guest'))->where('status','=','ready')->get();
            $selected_room=Room::find($request->input('id'));
            // dd($request->input('selected_room'));
            // dd($request->input('selected_room'));

            $rooms->push($selected_room);




            foreach($rooms as $room){
               $id=$room->id;
               $reservations=Reservation::where('room_id','=',$id)->where('status','!=','expierd')->get();
               if($reservations==null){ break;}
               foreach($reservations as $reservation){
                if($reservation->id==$request->input('reservation_id')){
                    continue;
                }
                    if(($check_in < $reservation->check_in
                    && $check_out < $reservation->check_in)
                    ||( $check_in > $reservation->check_out
                    && $check_out > $reservation->check_out)){
                        continue;
                    }else{
                        $rooms = $rooms->reject(function ($value) use ($id) {
                            // dd($value->id);
                            return $value->id == $id;
                        });
                    }
                }

            }
            // dd($selected_room);

            // $check_in=Carbon::parse($request->input('check_in'));
            // $check_out=Carbon::parse($request->input('check_out'));
            // $deffrant_in_days= $check_out->diffInDays($check_in);
            // $total_price=$deffrant_in_days*$price;

            return view('rooms',[
                'rooms'=>$rooms,
                's_check_in'=>$check_in,
                's_check_out'=>$check_out,
                'selected_room'=>[$selected_room],
                'reservation_id'=>$request->input('reservation_id')
            ]);

        }else{
            // dd($request->all());

            $id=$request->input('id');
            $number_of_guests=$request->input('guest');

            $check_in=Carbon::parse($request->input('check_in'));
            $check_out=Carbon::parse($request->input('check_out'));

            $deffrant_in_days= $check_out->diffInDays($check_in);

            $timezone = new \DateTimeZone('Egypt');
            $dateTime = new \DateTime('now', $timezone);
            $currentDateTime = $dateTime->format('Y-m-d');
            // dd($check_in->format('Y-m-d'));
            if($check_in->format('Y-m-d')<$currentDateTime||$check_in==null){
                return redirect()->route('rooms')->with('success', 'not valid check in date');
            }
            if($check_out<$currentDateTime||$check_out==null){
                return redirect()->route('rooms')->with('success', 'not valid check out date');
            }
            if($check_out<=$check_in){
                return redirect()->route('rooms')->with('success', 'not valid date ');
            }
            $rooms=Room::where('num_guests','=',$request->input('guest'))->get();


            if(count($rooms)==0){
                return redirect()->route('rooms')->with('success', 'no rooms avilabale');
            }
            // dd($rooms);
            foreach($rooms as $room){
               $id=$room->id;
               $reservations=Reservation::where('room_id','=',$id) ->where(function ($query) {
                $query->where('status', '!=', 'expired')
                    ->orWhereNull('status');
                })->get();

               if($reservations==null){ continue;}
            //    dd($reservations);
               foreach($reservations as $reservation){
                    if(($check_in < $reservation->check_in
                    && $check_out < $reservation->check_in)
                    ||( $check_in > $reservation->check_out
                    && $check_out > $reservation->check_out)){
                        continue;
                    }else{

                        $rooms = $rooms->reject(function ($value) use ($id) {
                            // dd($value->id);
                            return $value->id == $id;
                        });

                        // dd($rooms);
                    }
                }

            }
            // dd($selected_room);
            if($rooms==null){
                return redirect()->route('add.reservation')->with('success', 'no rooms avilabale');
            }
            // $check_in=Carbon::parse($request->input('check_in'));
            // $check_out=Carbon::parse($request->input('check_out'));
            // $deffrant_in_days= $check_out->diffInDays($check_in);
            // $total_price=$deffrant_in_days*$price;
            // dd($rooms);
            return view('rooms',[
                'rooms'=>$rooms,
                's_check_in'=>$check_in,
                's_check_out'=>$check_out,
                'selected_room'=>null

            ]);

        }

    }

}
