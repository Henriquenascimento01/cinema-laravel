<?php

namespace App\Services;

use App\Http\Requests\ValidateFormRoomsCreate;
use App\Models\Room;
use App\Models\Session;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ValidateFormSessionCreate;


class RoomsValidate
{

    // retorna todas as salas que possuem sessões cadastradas por data
    public static function roomsInSession(ValidateFormSessionCreate $request)
    {
        return Session::where('date', $request->date)
            ->where('room_id', $request->room_id)
            ->orderBy('time_initial')
            ->get();
    }

    // verifica se a sala já está em uso antes de criar/editar uma nova sessão
    public static function usedRoom(ValidateFormSessionCreate $request)
    {
        $registredSessions = RoomsValidate::roomsInSession($request)->toArray();

        $sessionInit = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));
        $sessionFinish = new DateTime($request->date . $request->time_finish, new DateTimeZone('America/Sao_Paulo'));

        $sessionInit = $sessionInit->format('H:i:s');
        $sessionFinish = $sessionFinish->format('H:i:s');


        foreach ($registredSessions as $session) {

            if ($sessionInit == $session['time_initial'] && $sessionFinish == $session['time_finish']) {

                return true;
            }

            if ($sessionInit >= $session['time_initial']) {

                if ($sessionInit <= $session['time_finish']) {

                    return true;
                }
            } else if ($session['time_finish'] <= $sessionFinish) {

                return true;
            }

            if ($sessionFinish >= $session['time_initial'] && $sessionFinish <= $session['time_finish']) {

                return true;
            }
        }

        return false;
    }


    // Verifica se a sala está em tempo de limpeza no momento de criar uma nova sessão
    public static function clearning(ValidateFormSessionCreate $request)
    {
        $sessions = RoomsValidate::roomsInSession($request);

        foreach ($sessions as $session) {

            if ($session->room_id == $request->room_id) {

                $sessionDateTimeAdded = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));
                $sessionDateTime = new DateTime($session->date . $session->time_initial, new DateTimeZone('America/Sao_Paulo'));

                $timeEndSession = new DateTime($session->date . $session->time_finish, new DateTimeZone('America/Sao_Paulo'));

                $clearningMinutes = new DateTime('America/Sao_Paulo');
                $clearningMinutes->setTimestamp(strtotime('+30 minutes', $timeEndSession->getTimestamp()));

                if ($sessionDateTimeAdded > $sessionDateTime && $sessionDateTimeAdded < $clearningMinutes) {

                    return true;
                }
            }
        }
    }

    //verifica se a sessão com a sala cadastrada está sendo atualizada (correção paliativa para não aprensentar sala em uso)
    // public static function checkUpdated(ValidateFormSessionCreate $request)
    // {
    //     if ($request->_method == 'PUT') {

    //         $registredSessions = RoomsValidate::roomsInSession($request)->toArray();

    //         $sessionInit = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));
    //         $sessionFinish = new DateTime($request->date . $request->time_finish, new DateTimeZone('America/Sao_Paulo'));

    //         $sessionInit = $sessionInit->format('H:i:s');
    //         $sessionFinish = $sessionFinish->format('H:i:s');

    //         foreach ($registredSessions as $session) {

    //             if ($sessionInit == $session['time_initial'] && $sessionFinish == $session['time_finish']) {

    //                 return true;
    //             }

    //             if ($sessionInit >= $session['time_initial']) {

    //                 if ($sessionInit <= $session['time_finish']) {

    //                     return true;
    //                 }
    //             } else if ($session['time_finish'] <= $sessionFinish) {

    //                 return true;
    //             }

    //             if ($sessionFinish >= $session['time_initial'] && $sessionFinish <= $session['time_finish']) {

    //                 return true;
    //             }
    //         }
    //     }
    //     return true;
    // }
    // }
}
