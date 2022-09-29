<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Session;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


// class RoomsValidate
// {

//     public static function IsMovieaRoom(Request $request)
//     {
//     }


//     public static function usedRoom(Request $sessionAdded)
//     {
//         $orndenedSessions = Session::getSessionsWithMovies();

//         foreach ($orndenedSessions as $sessions) {
//             if ($sessions->room->number == $sessionAdded->room_id) {

//                 $sessionDateTime = new DateTime($sessions->date . $sessions->time, new DateTimeZone('America/Sao_Paulo'));
//                 $sessionEndedIn = new DateTime($sessions->date . $sessions->time_finish, new DateTimeZone('America/Sao_Paulo'));
//                 $sessionToAddDateTime = new DateTime($sessionAdded->date . $sessionAdded->time, new DateTimeZone('America/Sao_Paulo'));

//                 if ($sessionToAddDateTime > $sessionDateTime && $sessionToAddDateTime < $sessionEndedIn) {
//                     return true;
//                 }
//             }
//         }
//     }
// }
