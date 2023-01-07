<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //
    public function sliders(){
        $sliders=Slider::all();
        return view('admin.sliders.index',compact('sliders'));
   }
    public function addsliders(){
        return view('admin.sliders.add');
    }
    public function sliderstore(SliderRequest $request){
        if($request->hasFile('slider_image')){
            //Image upload
                $filenameWithExt = $request->file('slider_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('slider_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
             
            $request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);
              
  
          }
           $slider = new Slider();
            $slider->descriptionone = $request->descriptionone;
           $slider->descriptiontwo = $request->descriptiontwo;
            
           
          
           $slider->slider_image = $fileNameToStore;
           $slider->save();
          return redirect()-> route('sliders')->with('success','You product has been submitted successfully'); 
    }

    public function destroy($id){
        $slider=Slider::find($id);
        if($slider->slider_image != "default.jpg"){
            // Delete Image
            Storage::delete('public/slider_images/'.$slider->slider_image);

        }
        $slider->delete();

    }
}
