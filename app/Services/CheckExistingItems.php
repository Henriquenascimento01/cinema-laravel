<?php

namespace App\Services;

use App\Http\Requests\ValidateClassificationFormCreate;
use App\Http\Requests\ValidateTagsFormCreate;
use App\Models\Classification;
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
}
