<?php

namespace App\Services;

use App\Http\Requests\ValidateFormMoviesCreate;
use App\Models\Movie;
use Illuminate\Support\Str;

class ExistingMovies
{
    // verifica se o filme cadastrado já existe

    public static function checkRepeated(ValidateFormMoviesCreate $request)
    {

        $movies = Movie::all();

        foreach ($movies as $movie) {
            if (Str::lower($request->name) == Str::lower($movie->name)) {
                return true;
            }
        }
        return false;
    }
}
