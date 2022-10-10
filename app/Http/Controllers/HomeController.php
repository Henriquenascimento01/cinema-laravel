<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilterSessions;
use App\Services\Search;
use Illuminate\Support\Str;
use App\Models\Session;

class HomeController extends Controller
{
    public function index()
    {
        $sessions = FilterSessions::latest();

        return view('layouts.index', [
            'sessions' => $sessions
        ]);
    }

    public function allSessions()
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
