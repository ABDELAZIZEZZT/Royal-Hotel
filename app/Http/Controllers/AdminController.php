<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Physical_user;
use App\Models\Reservation;
use App\Models\Room_photo;
use App\Models\Slider_photo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
    function index(){
        $data=Slider_photo::orderBy('periorty', 'desc')->get();

        return view('Admin.index',['slides'=>$data]);
    }








    function Admin(){
        $not_user = User::where('role', '!=', 'user')->get();
        return view('Admin.admin',['Admins'=>$not_user]);
    }
    function add_admin(){
        return view('Admin.add_admin');
    }
    function Realyadd_admin(Request $request){
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

        return redirect('/Admin/add_admin')->with('success', 'User created successfully!');
    }
    function update_admin($id){
        // dd($id);

        $admin=User::find($id);
        return view('Admin.update_admin',['admin'=>$admin]);

    }
    function realyupdate_admin(Request $request,$id){
        $admin=User::find($id);
        $admin->password = bcrypt($request->password);
        $admin->phone_number=$request->input('phone_number');
        $admin->address=$request->input('address');
        $admin->role=$request->input('role');
        $admin->save();
        return redirect('/Admin/admins')->with('success', 'admin updated successfully!');

    }
    function delete_admin($id){
        $admin=User::find($id);
        $admin->delete();
       return redirect()->route('admin')->with('success', 'deleted successfully.');

    }







}
