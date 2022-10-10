<?php


namespace App\Services;

use App\Models\Session;

class FilterSessions
{

    public static function latest()
    {

        $actualDate = CurrentDate::get();
        $tenDaysLeft = date('Y-m-d H:i:s', strtotime('-10 days', $actualDate->getTimestamp())); // Armazena data 10 dias passados
        $fiveDayMore = date('Y-m-d H:i:s', strtotime('+5 days', $actualDate->getTimestamp())); // Armazena data 5 dias a frente


        $sessions = Session::all();

        foreach ($sessions as $session) {
            if ($session['date'] <= $tenDaysLeft && $session['date'] <= $fiveDayMore) {
                return true;
            }
        }

        return false;
    }
}
