<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use App\Http\Requests\ValidateFormSessionCreate;
use App\Services\CurrentDate;

class ValidatePastSessionDate
{

    public static function pastDate(ValidateFormSessionCreate $request): bool
    {
        date_default_timezone_set('America/Sao_Paulo');

        $sessionTime = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));
        $currentDate = CurrentDate::get();


        if ($sessionTime < $currentDate) {
            return true;
        }

        return false;
    }
}
