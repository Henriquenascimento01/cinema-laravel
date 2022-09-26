<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function homePage(){
        

    //     return view ('home'); 
    // }

    public function __invoke(Request $request)
    {
        $user = auth()->user();
        return view('home'); 
    }
}
