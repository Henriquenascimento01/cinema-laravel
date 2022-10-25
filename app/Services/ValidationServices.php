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

            return "Cinema fechado";
            // return back()->with('msg-error', 'Cinema fechado.');
        }

        if (ValidateSessionDate::pastDate($request)) {

            return "Não é possivel criar uma sessão com uma data que já passou";
            // return back()->with('msg-error', 'Não é possivel criar uma sessão com uma data que já passou');
        }

        if (RoomsValidate::usedRoom($request)) {

            return "Sala em uso";
            // return back()->with('msg-error', 'Sala em uso.');
        }

        if (ValidateSessionDate::finishAndStart($request)) {

            return "Não é possivel um filme começar e terminar no mesmo horário.";
            // return back()->with('msg-error', 'Não é possivel um filme começar e terminar no mesmo horário.');
        }

        if (ValidateSessionDate::checkInverted($request)) {

            return "Horário de inicio maior do que o de finalização";
            // return back()->with('msg-error', 'Horário de inicio maior do que o de finalização.');
        }

        if (RoomsValidate::clearning($request)) {

            return "Sala em tempo de limpeza";
            // return back()->with('msg-error', 'Sala em tempo de limpeza');
        }
    }
}
