<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Physical_user;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Room;
use App\Models\Slider_photo;
use App\Models\User_photo;
use Illuminate\Http\Request;

class userController extends Controller
{
    function index(){
        // dd(auth()->user());
        $slides=Slider_photo::all();
        $rooms=Room::paginate(5);


        return view('index',['slides'=>$slides,'rooms'=>$rooms]);
    }
    function users(){
        $p_user=Physical_user::paginate(10);
        $user=User::where('role', '=', 'user')->paginate(10);
        return view('Admin.users',['users'=>$user,'p_users'=>$p_user]);

    }
    function web_users(Request $request){
        $user=User::paginate(10);
        $found=0;
        if($request->input('phone_number')!=null){
            $phone_number=$request->input('phone_number');
            $user_s=User::where('phone_number','=',$phone_number)->get();
            // dd($reservation_s);
           if($user_s!=null) $found=1;
            return view('Admin.web_user',['users'=>$user,'user_s'=>$user_s,'found'=>$found]);
        }elseif($request->input('name')!=null){
            $name=$request->input('name');
            $user_s=User::where('name', 'like', '%' . $name . '%')->get();
            // dd($room);


            // dd($reservation_s);
           if($user_s!=null) $found=1;

            return view('Admin.web_user',['users'=>$user,'user_s'=>$user_s,'found'=>$found]);

        }else{
            return view('Admin.web_user',['users'=>$user,'found'=>$found]);
        }


    }
    function add_users(){
        return view('Admin.add_user');
    }
    function add_p_users(){
        return view('Admin.add_p_user');
    }
    function Realyadd_users(Request $request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',

        ]);

        // Create a new user
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->phone_number=$request->input('phone_number');
        $user->address=$request->input('address');
        $user->role=$request->input('role');

        $user->save();

        return redirect('/Admin/add_user')->with('success', 'User created successfully!');
    }
    function Realyadd_p_users(Request $request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:physical_users,phone_number',
            'address' => 'required',
            'national_id'=>'required|numeric|digits:14|unique:physical_users,national_id'

        ]);

        // Create a new user
        $user = new Physical_user($request->all());
        $user->name = $request->input('name');
        $user->phone_number=$request->input('phone_number');
        $user->address=$request->input('address');
        $user->national_id=$request->input('national_id');
        $user->save();

        return redirect('/Admin/users')->with('success', 'User created successfully!');
    }
    function user_profile($id,$type){

        if($type=='web') {
            $user=User::find($id);
            $reviews=Review::where('user_id','=',$id)->where('user_type','=',$type)->get();
            // dd($reviews);
            $reservations=Reservation::where('user_id','=',$id)->where('user_type','=',$type)->get();
        }else{
            $user=Physical_user::find($id);
            $reviews=Review::where('user_p_id','=',$id)->where('user_type','=',$type)->get();
        // dd($reviews);
            $reservations=Reservation::where('user_p_id','=',$id)->where('user_type','=',$type)->get();
        }
        return view('Admin.user_profile',['user'=>$user,'type'=>$type,'reviews'=>$reviews,'reservations'=>$reservations]);
    }
    function update_user($id){
        // dd($id);

        $user=User::find($id);
        return view('Admin.update_user',['user'=>$user]);

    }
    function update_p_user($id){
        // dd($id);

        $user=Physical_user::find($id);
        return view('Admin.update_p_user',['user'=>$user]);

    }
    function realyupdate_user(Request $request,$id,$type){
        if($type=='web'){

            $user=User::find($id);
            // dd($request->all());
            $user->password = bcrypt($request->password);
            $user->phone_number=$request->input('phone_number');
            $user->address=$request->input('address');
            if($request->input('check_in')!=null)$user->check_in='1';
            if($request->input('check_out')!=null){
                $user->check_in='0';
                $user->check_out='0';
                //هنا هنعمل ايميل بيقول لليوزر شكرا علي مش عارف اييه و نبعتله الريفيو بادج
            }
            $user->save();
            return redirect('/Admin/reservation')->with('success', 'admin updated successfully!');
        }else{

        }

    }
    function realyupdate_p_user(Request $request,$id){
        $user=Physical_user::find($id);
        $user->phone_number=$request->input('phone_number');
        $user->address=$request->input('address');
        $user->national_id=$request->input('national_id');
        if($request->input('check_in')!=null)$user->check_in='1';
        if($request->input('check_out')!=null)$user->check_out='1';
        $user->save();
        return redirect('/Admin/users')->with('success', 'user updated successfully!');

    }
     function delete_user($id){
        //  dd($id);
         $user=User::find($id);
         $user->delete();
        return redirect()->route('web_users')->with('success', 'deleted successfully.');
     }
    function delete_p_user($id){
        $user=Physical_user::find($id);
        $user->delete();
       return redirect()->route('users')->with('success', 'deleted successfully.');

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function show_profile($id){
        $user=User::where('id',$id)->first();

        $photo=User_photo::where('user_id',$id)->first();
        $review=Review::where('user_id',$id)->get();
        $reservations=Reservation::where('user_id',$id)->get();

        return view('profile',['user'=>$user,'photo'=>$photo,'reviews'=>$review,'reservations'=>$reservations]);

    }

    function user_update_profile(Request $request){
        $user=User::find(auth()->user()->id);
        $user->name=$request->input('name');
        $user->address=$request->input('address');
        if($request->file('photo')!=null){
            $request->validate([
                'photo' => '|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('photos', $filename, 'public');
            $user->photo()->updateOrCreate([], ['user_id'=>auth()->user()->id,'user_photo' => $filename]);
        }
        $user->save();
        return redirect()->route('user.profile',['id'=>auth()->user()->id]);


    }



}
