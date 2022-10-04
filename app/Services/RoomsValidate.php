<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Session;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ValidateFormSessionCreate;


class RoomsValidate
{
    // Verifica se a sala já está em uso antes de criar uma nova sessão

    public static function usedRoom(ValidateFormSessionCreate $request)
    {

        // sessões existentes no banco

        $registredSessions = Session::where('date', $request->date)
            ->where('room_id', $request->room_id)
            ->get()->all();

        $sessionInit = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo')); // data e hora de inicio da sessão
        $sessionFinish = new DateTime($request->date . $request->time_finish, new DateTimeZone('America/Sao_Paulo')); // horário de termino da sessão

        $sessionInit = $sessionInit->format('H:i:s');
        $sessionFinish = $sessionFinish->format('H:i:s');


        foreach ($registredSessions as $session) {

            // dd($sessionInit->format('H:i:s'), $session->time_initial, $session->time_finish);

            if ($sessionInit == $session->time_initial && $sessionFinish == $session->time_finish) {
                return true;
            }

            if ($sessionInit > $session->time_initial && $sessionFinish < $session->time_finish) {
                return true;
            }
        }

        return false;
    }
}
