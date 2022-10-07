<?php

namespace App\Services;

use App\Services\RoomsValidate;
use App\Services\ValidateSessionDate;
use App\Services\ValidateCineOpened;
use App\Http\Requests\ValidateFormSessionCreate;



class ValidationServices
{

    public static function validAll(ValidateFormSessionCreate $request)
    {

        if (!ValidateCineOpened::cineOpened($request)) {

            return back()->with('msg-error', 'Cinema fechado.');
            return false;
        }

        if (ValidateSessionDate::pastDate($request)) {

            return back()->with('msg-error', 'Não é possivel cadastrar uma sessão com uma data que já passou.');
            return false;
        }

        if (RoomsValidate::usedRoom($request)) {

            return back()->with('msg-error', 'Sala em uso.');
            return false;
        }

        if (ValidateSessionDate::finishAndStart($request)) {

            return back()->with('msg-error', 'Não é possivel um filme começar e terminar no mesmo horário.');
            return false;
        }
    }
}
