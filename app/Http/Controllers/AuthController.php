<?php

namespace App\Http\Controllers;

use App\Models\reset_password_tokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\reset_password;
use App\Models\Admin;
use App\Models\Owner;
use Illuminate\Support\Str;
use App\Models\Reservation;
use App\Models\Reset_tokens;

class AuthController extends Controller
{
    //
    function login_view(){

        return view('login');
    }
    function login(Request $request){

        $validator = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|',
        ]);

        $email=$request->input('email');


        $user=User::where('email','=',$email)->first();




        if($user){

            if($user->verification){
                $credentials = $request->only('email', 'password');
                $guards = array_slice(config('auth.guards'), 0, -1);

                foreach(array_keys($guards) as $gard){
                    if(Auth::guard($gard)->attempt($credentials)) {
                        return redirect()->route('index')->with('successs','');
                    }
                }
                return back()->with('error', 'Error Email or Password');
            }else {
                return redirect()->route('verify.email',['token'=>$user->remember_token])->with('success','please verifay your email');
            }
        }
        return back()->with('error', 'please register first');
    }


    function register_view(){
        return view('register');
    }
    function register(Request $request){
        // dd($request->all());
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone_number' => 'required|string|max:11|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $token=Str::random(10);
        $check=User::where('remember_token',$token)->get();


        while($check->isNotEmpty()){
            $token=Str::random(10);
            $check=User::where('remember_token',$token)->get();
        }


        $this->send_email($request->input('email'),$token);

        $user=User::create([
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'phone_number'=>$request->input('phone_number'),
            'remember_token'=>$token,
        ]);

        return redirect()->route('verify.email',['token'=>$token])->with('success','please verifay your email');

    }
    function email_verification_view(){
        return view('verify');
    }
    function email_verification(Request $request){
        $token=$request->input('token');
        // dd($token);
        $user=User::where('remember_token',$token)->first();

        if($user){
            $user->verification=true;
            $user->save();
            return redirect()->route('login.view')->with('success','verifaied success');
        }else{
            return back()->with('error','not correct code');
        }
    }


    function logout(){

        Auth::logout();

        return redirect()->route('login.view');
    }
    function reset_password(){
        return view('reset_password');
    }
    function reset(Request $request){
       $user=User::where('email',$request->input('email'))->first();
       if($user){
        $token=$user->remember_token;
           $this->send_email($request->input('email'),$token);
       }
       return view('put_token',['email' => $request->input('email')]);
    }
    function send_email ($email,$token){
        // dd($token);
        Mail::to("zezo@email.com")->send(new reset_password($token));

    }
    function check_token (Request $request){

       $token=$request->input('token');
       $email=$request->input('email');
       $user=User::where('email',$email)->first();

       if($token!=$user->remember_token)back()->with('error','not correct token');
        else{
            return view('reset_password_',['email'=>$request->input('email')]);
        }
    }
    function password_verification( Request $request){
        $validator = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user=User::where('email',$request->input('email'))->first();
        if($user){
            $user->password=Hash::make($request->input('password'));
            $user->save();
            return  redirect()->route('login.view')->with('success','password reseted successfully');
        }else{
            return  redirect()->route('login.view')->with('error','please make register first');
        }

    }


}


