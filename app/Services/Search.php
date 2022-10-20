<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Search
{
    
    public static function movies($request)
    {
        $date = str_replace('/', '-', $request);
        $dateFormat = date('Y-m-d', strtotime($date));

        return Session::whereHas('room', function (Builder $query) use ($request) {
            $query->where('number', 'like', $request);
        })
            ->orWhereHas('movie', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%' . $request . '%')
                    ->orWhere('duration', 'like', '%' . $request . '%')
                    ->orWhere('movies.tag_id', 'like', '%' . $request . '%');
            })

            ->orWhere('id', 'like', $request)
            ->orWhere('date', 'like', $dateFormat)
            ->get();
    }

    // try {
    //     $movies = DB::table('movies')
    //         ->join('sessions', 'movies.id', '=', 'sessions.movie_id')
    //         ->where('movies.name', )
    //         ->orWhere('movies.tag', 'like', '%' . $request . '%')
    //         ->select(
    //             'movies.name',
    //             'movies.tag',
    //             'movies.id',
    //             'sessions.id',
    //             'sessions.image',
    //             'sessions.date',
    //             'sessions.time_initial',
    //             'sessions.time_finish'
    //         )
    //         ->get();

    //     return $movies;
    // } catch (\PDOException $e) {
    //     $e->getMessage();
    // }
}
