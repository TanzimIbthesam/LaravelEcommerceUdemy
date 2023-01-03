<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        return view('client.index');
    }
    public function shop(){
        return view('client.shop');
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
