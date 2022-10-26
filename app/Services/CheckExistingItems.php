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


        if ($request->_method == "PUT") {

            foreach ($classifications as $classification) {

                if (Str::lower($request->name) == Str::lower($classification->name)) {
                    return true;
                }
                return false;
            }
        }


        foreach ($classifications as $classification) {

            if (Str::lower($request->name) == Str::lower($classification->name)) {

                return true;
            }
        }
        return false;
    }

    public static function tags(ValidateTagsFormCreate $request)
    {
        $tags = Tag::getAll();

        if ($request->_method == "PUT") {

            foreach ($tags as $tag) {

                if (Str::lower($request->name) == Str::lower($tag->name)) {
                    return true;
                }
                return false;
            }
        }


        foreach ($tags as $tag) {

            if (Str::lower($request->name) == Str::lower($tag->name)) {

                return true;
            }
        }
        return false;
    }


    public static function rooms(ValidateFormRoomsCreate $request)
    {

        $rooms = Room::getAll();

        if ($request->_method == "PUT") {

            foreach ($rooms as $room) {

                if (Str::lower($request->number) == Str::lower($room->number)) {
                    return true;
                }
                return false;
            }
        }


        foreach ($rooms as $room) {

            if (Str::lower($request->name) == Str::lower($room->name)) {

                return true;
            }
        }
        return false;
    }

    public static function movies(ValidateFormMoviesCreate $request)
    {

        $movies = Movie::all();

        if ($request->_method == "PUT") {

            foreach ($movies as $movie) {

                if (Str::lower($request->name) == Str::lower($movie->name)) {
                    return true;
                }
                return false;
            }
        }

        foreach ($movies as $movie) {

            if (Str::lower($request->name) == Str::lower($movie->name)) {
                return true;
            }
        }
        return false;
    }


    public static function moviesUpdate(FormEditMovies $request)
    {
        //dd($request);
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
