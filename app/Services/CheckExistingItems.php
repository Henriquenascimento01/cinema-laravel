<?php

namespace App\Services;

use App\Http\Requests\FormEditMovies;
use App\Http\Requests\ValidateClassificationFormCreate;
use App\Http\Requests\ValidateFormMoviesCreate;
use App\Http\Requests\ValidateFormRoomsCreate;
use App\Http\Requests\ValidateTagsFormCreate;
use App\Models\Classification;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Tag;
use Illuminate\Support\Str;

class CheckExistingItems
{


    public static function classifications(ValidateClassificationFormCreate $request)
    {

        $classifications = Classification::getAll();

        foreach ($classifications as $classification) {

            if ($request->_method == "PUT") {

                if (Str::lower($request->name) == Str::lower($classification->name)) {
                    return true;
                }
            }

            if (Str::lower($request->name) == Str::lower($classification->name)) {

                return true;
            }
        }
        return false;
    }

    public static function tags(ValidateTagsFormCreate $request)
    {
        $tags = Tag::getAll();


        foreach ($tags as $tag) {

            if ($request->_method == "PUT") {

                if (Str::lower($request->name) == Str::lower($tag->name)) {
                    return true;
                }
            }

            if (Str::lower($request->name) == Str::lower($tag->name)) {

                return true;
            }
        }
        return false;
    }


    public static function rooms(ValidateFormRoomsCreate $request)
    {

        $rooms = Room::getAll();


        foreach ($rooms as $room) {

            if ($request->_method == "PUT") {

                if ($request->number == $room->number) {
                    return true;
                }
            }

            if ($request->number == $room->number) {

                return true;
            }
        }
        return false;
    }

    public static function movies(ValidateFormMoviesCreate $request)
    {

        $movies = Movie::all();

        foreach ($movies as $movie) {

            if (Str::lower($request->name) == Str::lower($movie->name)) {
                return true;
            }
        }
        return false;
    }


    public static function moviesUpdate(FormEditMovies $request)
    {
        $movies = Movie::get();

        foreach ($movies as $movie) {

            if (Str::lower($request->name) == Str::lower($movie->name) && $request->tag_id == $movie->tag_id && $request->classification_id == $movie->classification_id && $request->description == $movie->description) {
                return false;
            }

            if (Str::lower($request->name) == Str::lower($movie->name)) {
                return true;
            }
        }
        return false;
    }
}
