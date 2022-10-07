<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use App\Http\Requests\ValidateFormSessionCreate;
use App\Services\CurrentDate;

class ValidateSessionDate
{
    // verifica se a data de criação da sessão é uma data passada

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

    // verifica se o horário de inicio e termino da sessão são iguais

    public static function finishAndStart(ValidateFormSessionCreate $request)
    {

        $sessionInit = $request->time_initial;
        $sessionFinish = $request->time_finish;

        if ($sessionInit == $sessionFinish) {
            return true;
        }
        return false;
    }
}
