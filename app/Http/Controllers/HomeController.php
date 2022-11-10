<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilterSessions;
use App\Services\Search;
use Illuminate\Support\Str;
use App\Models\Session;

class HomeController extends Controller
{
    // retorna as sessões com base no filtro proposto ( utilizado para visualização inicial do visitante )
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
        $sessions = Search::movies(Str::lower($request->search));

        return view('layouts.show', [
            'sessions' => $sessions
        ]);
    }
}
