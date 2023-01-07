<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::with('category')->paginate(1);

        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('admin.product.add',compact('categories'));
    }
    // $product=App\Models\Product::find(2);
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if($request->hasFile('image')){
          //Image upload
              $filenameWithExt = $request->file('image')->getClientOriginalName();
              // Get just filename
              $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
              // Get just ext
              $extension = $request->file('image')->getClientOriginalExtension();
              // Filename to store
              $fileNameToStore= $filename.'_'.time().'.'.$extension;

          $request->file('image')->storeAs('public/all_images/product_images',$fileNameToStore);


        }else{
            $request->image="default.jpg";
        }
         $product = new Product();
          $product->name = $request->name;
         $product->price = $request->price;
          $product->category_id =$request->category_id;


         $product->image = $fileNameToStore;
         $product->save();
        return redirect()-> route('product.index')->with('success','You product has been submitted successfully');
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
        return view('admin.product.edit',['product'=>Product::find($id),'categories'=>Category::all()]);
    }

    public function activateProduct($id){
        $product=Product::find($id);
         $product->status=1;
         $product->update();
         return redirect()-> route('product.index')->with('success','You product has been activated successfully');
    }
    public function deactivateProduct($id){
        $product=Product::find($id);
         $product->status=0;
         $product->update();
         return redirect()-> route('product.index')->with('success','You product has been unactivated successfully');
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        //
        $product=Product::find($id);

        //

         if($request->hasFile('image')){

            //Image upload
            // unlink(public_path('product_images').'/'.$product->image);
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $request->file('image')->storeAs('public/all_images/product_images',$fileNameToStore);
                if($product->image != "default.jpg"){
                    Storage::delete('public/all_images/product_images/'.$product->image);

                }
                $product->image=$fileNameToStore;
                // if($product->image){
                //     Storage::delete('public/product_images/'.$product->image);

                // }

          }
        //    $product->category_id=$request->category_id;
          $product->name=$request->name;
          $product->price=$request->price;


          $product->update();
        //  $product->category_id=$request->input('category_id');
        //  $product->save();
        return redirect()-> route('product.index')->with('success','You product has been updated successfully');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $product=Product::find($id);

        if($product->image != "default.jpg"){
            // Delete Image
            Storage::delete('public/all_images/product_images/'.$product->image);
        }

        //  Storage::delete();
        $product->delete();
        return redirect()-> route('product.index')->with('success','You category has been deleted successfully');
    }

    public function view_product_by_category($category_name){
          $category=Category::find($category_name);
          return view('client.productbycategory',compact('category'));
    }
}
