<?php

namespace App\Services;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateFormSessionCreate;

class ValidatePastSessionDate
{

    public static function pastDate(ValidateFormSessionCreate $request)
    {
        $request->validated();
        // dd($request);

        $sessionDateInit = $request->date;
        $sessionTimeInit = $request->time_initial;


        if ($sessionDateInit < new DateTime() && $sessionTimeInit < new DateTime()) {
            return false;
        }
    }
}
