<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;


class AboutController extends Controller
{
    //
    function about(){
        $about=About::paginate(10);
        return view('Admin.about',['about'=>$about]);
    }
    function add_about(){
        return view('Admin.add_about');
    }
    function realy_add_about(Request $request){
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // dd($request->all());
        $photo = $request->file('photo');
        $filename = time() . '_' . $photo->getClientOriginalName();
        $photo->storeAs('photos', $filename, 'public');
        // dd($request->all());
        $about = About::create([
            'photo' => $filename,
            'head_line'=>$request->input('head_line'),
            'description' => $request->input('descriptions'),
            'path' => $request->input('path')
        ]);
        return redirect()->route('admin.add_about')->with('success', 'add successfully.');

    }

    function update_about($id){
        $about=About::find($id);
        // dd($roomPhotos);
        return view('Admin.update_about',['about'=>$about,'id'=>$id]);
    }

    function realy_update_about(Request $request,$id){

        if($request->file('photo')!=null){
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $photo = $request->file('photo');
        $filename = time() . '_' . $photo->getClientOriginalName();
        $photo->storeAs('photos', $filename, 'public');
        $about=About::find($id);
        $about->photo=$filename;
       $about->save();

       }

       $about=About::find($id);

       $about->description=$request->input('description');
       $about->head_line=$request->input('head_line');
       $about->path=$request->input('path');

       $about->save();
       return redirect()->route('update.about',['id'=>$id])->with('success', 'Updated successfully.');

    }
    function delet_about($id){
        $about=About::find($id);
        $about->delete();
       return redirect()->route('admin.about')->with('success', 'deleted successfully.');


    }

    function about_view(){
        $about=About::all();
        // dd($about);
        return view('about',['abouts'=>$about]);
    }

}
