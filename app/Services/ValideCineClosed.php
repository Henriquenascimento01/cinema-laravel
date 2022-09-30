<?php

namespace App\Services;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Http\Requests\ValidateFormSessionCreate;

class ValideCineClosed
{

  public static function cineClosed(ValidateFormSessionCreate $request): bool
  {
    $request->validated();

    date_default_timezone_set('America/Sao_Paulo');

    $hourOpening = new DateTime($request->date . '10am');
    $hourClosed  = new DateTime($request->date . '11pm');



    $session = new DateTime($request->date . $request->time_initial);

    //dd($session < $hourOpening || $session > $hourClosed);


    if ($session < $hourOpening || $session > $hourClosed) {
      return true;
    }
    return false;
  }
}
