<?php

namespace App\Services;

use DateTime;
use DateTimeZone;




class CurrentDate
{

    public static function get()
    {

        return new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    }
}
