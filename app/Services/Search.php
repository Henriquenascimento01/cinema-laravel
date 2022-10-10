<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Support\Facades\DB;

class Search
{

    public static function movies(string $request)
    {

        try {
            $movies = DB::table('movies')
                ->join('sessions', 'movies.id', '=', 'sessions.movie_id')
                ->where('movies.name', 'like', '%' . $request . '%')
                ->orWhere('movies.tag', 'like', '%' . $request . '%')
                ->select(
                    'movies.name',
                    'movies.tag',
                    'movies.id',
                    'sessions.id',
                    'sessions.image',
                    'sessions.date',
                    'sessions.time_initial',
                    'sessions.time_finish'
                )
                ->get();

            return $movies;
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }       
}
