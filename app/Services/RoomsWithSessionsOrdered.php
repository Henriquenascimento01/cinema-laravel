<?php

namespace App\Services;


use App\Models\Session;

class RoomsWithSessionsOrdered
{


    public static function get()
    {
        return Session::with('movie', 'room')
            ->orderBy('date')->orderBy('time_initial')
            ->orderBy('time_finish')
            ->get();
    }
}
