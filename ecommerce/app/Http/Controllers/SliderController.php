<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders=Slider::all();
        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        //
        if($request->hasFile('slider_image')){
            //Image upload
                $filenameWithExt = $request->file('slider_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('slider_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
             
            $request->file('slider_image')->storeAs('public/all_images/slider_images',$fileNameToStore);
              
  
          }
           $slider = new Slider();
            $slider->descriptionone = $request->descriptionone;
           $slider->descriptiontwo = $request->descriptiontwo;
            
           
          
           $slider->slider_image = $fileNameToStore;
           $slider->save();
          return redirect()->route('slider.index')->with('success','You slider has been uploaded successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.sliders.edit',['slider'=>Slider::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateSlider($id){
        $slider=Slider::find($id);
         $slider->status=1;
         $slider->update();
         return redirect()->route('slider.index')->with('success','You slider has been activated successfully'); 
    }
    public function deactivateSlider($id){
        $slider=Slider::find($id);
         $slider->status=0;
         $slider->update();
         return redirect()->route('slider.index')->with('success','You slider has been  successfully'); 
   }
    public function update(SliderUpdateRequest $request, $id)
    {
        //
        $slider=Slider::find($id);
        if($request->hasFile('slider_image')){
            //Image upload
                $filenameWithExt = $request->file('slider_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('slider_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $request->file('slider_image')->storeAs('public/all_images/slider_images',$fileNameToStore);
            
            if($slider->slider_image != "default.jpg"){
                Storage::delete('public/all_images/slider_images/'.$slider->slider_image);
               
            }
            
            $slider->slider_image=$fileNameToStore; 
  
          }
           
          $slider->descriptionone = $request->descriptionone;
          $slider->descriptiontwo = $request->descriptiontwo;
           
           $slider->update();
          return redirect()-> route('slider.index')->with('success','You product has been submitted successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $slider=Slider::find($id);
        if($slider->slider_image != "default.jpg"){
            // Delete Image
            Storage::delete('public/all_images/slider_images/'.$slider->slider_image);

        }
        $slider->delete();
        return redirect()-> route('slider.index')->with('success','You slider has been deleted successfully');
    }
}
