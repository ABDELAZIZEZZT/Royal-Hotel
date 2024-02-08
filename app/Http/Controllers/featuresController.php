<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class featuresController extends Controller
{
    //
    function features(){
        $features=Feature::paginate(5);
        return view('Admin.features',['features'=>$features]);
    }
    function add_feature_view() {
        return view('Admin.add_feature');

    }
    function add_feature(Request $request) {
        $feature=Feature::create([
            'feature'=>$request->input('feature'),
            'price'=>$request->input('price')
        ]);
        return redirect()->route('admin.features')->with('success','the feature created');

    }
    function feature_delete(Request $request){
        $feature=Feature::find($request->input('id'));
        $feature->delete();
        return redirect()->route('admin.features')->with('success','the feature deleted');

    }

    function features_update_view($id){
        $feature=Feature::find($id);
        return view('Admin.update_feature',['feature'=>$feature]);

    }
    function features_update(Request $request) {
        $feature=Feature::find($request->input('id'));
        $feature->feature=$request->input('feature');
        $feature->price=$request->input('price');
        $feature->save();

        return redirect()->route('admin.features')->with('success','the feature updated');
    }
}
