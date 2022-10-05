<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;
use App\Services\Search;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {

        $sessions = Session::all();


        return view('layouts.index', [
            'sessions' => $sessions
        ]);
    }


    public function search(Request $request)
    {
        $search = Search::movies(Str::lower($request->search));

        return view('layouts.show', [
            'movies' => $search
        ]);
    }
}
