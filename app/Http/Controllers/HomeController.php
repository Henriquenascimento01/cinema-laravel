<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;
use App\Services\CurrentDate;
use App\Services\FilterSessions;
use App\Services\Search;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $actualDate = CurrentDate::get();

        $tenDaysLeft = date('Y-m-d H:i:s', strtotime('-10 days', $actualDate->getTimestamp())); // Armazena data 10 dias passados
        $fiveDayMore = date('Y-m-d H:i:s', strtotime('+5 days', $actualDate->getTimestamp())); // Armazena data 5 dias a frente



        $sessions = Session::whereDate('date', '<=', $tenDaysLeft)
            ->orwhereDate('date', '<=', $fiveDayMore)
            ->get();

        // dd($sessions); 


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
