<?php

namespace App\Http\Controllers;

use App\Models\Slider_photo;
use Illuminate\Http\Request;

class SliderController extends Controller
{


    function slider(){

        return view('Admin.slider');
    }
    function addSlider(Request $request){
        // dd($request->all());
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
        ]);
        // dd($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('photos/sliders', $filename, 'public');

            $newData = Slider_photo::create([
                'name' => $request->input('name'),
                'periorty' => $request->input('priority'),
                'photo' => $filename
            ]);

            return redirect()->route('Admin.index')->with('success', 'Added successfully.');
        } else {
            return redirect()->route('slider')->with('error', 'File not provided.');
        }
    }

    function deleteSlider($id){
        $slide=Slider_photo::find($id);
        $slide->delete();
        return redirect()->route('Admin.index')->with('success', 'Item deleted successfully.');
    }
    function updateSlider($id){
        $slide=Slider_photo::find($id);

        return view('Admin.update_slide',['slide'=>$slide]);
    }
    function realy_updateSlider(Request $request,$id){
        $slide_2=Slider_photo::find($id);
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => '|string|max:255',
            'priority' => 'required|integer',
        ]);
        // dd($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('photos/sliders', $filename, 'public');
        }
            $slide=Slider_photo::find($id);
            $slide->name=$request->input('name');
            $slide->periorty=$request->input('priority');
            $slide->save();

            return redirect()->route('Admin.index')->with('success', 'updated successfully.');



    }
    //

}
