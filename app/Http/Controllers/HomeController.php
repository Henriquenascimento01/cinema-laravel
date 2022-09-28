<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;

class HomeController extends Controller
{
    public function index()
    {
        $sessions = Session::all();

        return view('layouts.index', ['sessions' => $sessions]);
    }
}
