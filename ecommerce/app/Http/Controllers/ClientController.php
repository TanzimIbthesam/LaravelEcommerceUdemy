<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){

         $sliders=Slider::all()->where('status',1);
        $products=Product::all()->where('status',1);
         return view('client.index',compact('sliders','products'));
    }
    public function shop(){
        $categories=Category::all();
        $products=Product::all();
        return view('client.shop',compact('categories','products'));
    }
    public function cart(){
        return view('client.cart');
    }
    public function checkout(){
        return view('client.cart');
    }
    public function login(){
        return view('client.login');
    }
    // public function login(){
    //     return view('client.login');
    // }
}
