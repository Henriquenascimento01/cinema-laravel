<?php

namespace App\Services;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class ValideCineClosed
{

  public static function cineClosed(Request $request): bool
  {

    $hourOpening = date("Y-m-d 10:00");
    $hourClosed  = date("Y-m-d 23:00");

    dd($hourOpening);

    $session = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));


    if ($session < $hourOpening || $session > $hourClosed) {
      return true;
    }
    return false;
  }
}
