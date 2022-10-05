<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;

// class SearchMovies
// {


//     public static function search(Request $request)
//     {

//         $search = request('search');

//         if ($search) {
//             return Movie::where([
//                 ['name', 'like', '%' . $search . '%']
//             ])->get();
//         } else {
//             return Session::all();
//         }
//     }
// }
