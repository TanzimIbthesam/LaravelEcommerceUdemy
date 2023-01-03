<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function uploadImage()
    {
        # code...
        return view('admin.upload.index');
    }

    public function saveimage(UploadRequest $request){
        Upload::create($request->validated());
        if($request->hasFile('image')){
            //Get file name with extension
            $fileNamewithExtension=$request->file('image')->getClientOriginalName();
            // dd($fileNamewithExtension);
            //just get File name 
            $fileName=pathinfo($fileNamewithExtension,PATHINFO_FILENAME);
            // dd($fileName);
            //just get the file extension 
            $fileextension=$request->file('image')->getClientOriginalExtension();
            // dd($fileextension);
            //File name to store 
            $fileNameforStoring=$fileName.''.time().'.'.$fileextension;;
        //   dd($fileNameforStoring);
            // dd($fileNameforStoring);
            //Upload image 
           $data=$request->file('image')->storeAs('public/product_images',$fileNameforStoring);
            

        }
        
       
    }
}
