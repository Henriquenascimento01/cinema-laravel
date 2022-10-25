<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Search
{

    public static function movies($request)
    {
        $date = str_replace('/', '-', $request);
        $dateFormat = date('Y-m-d', strtotime($date));

        return Session::whereHas('room', function (Builder $query) use ($request) {
            $query->where('number', 'like', $request);
        })
            ->orWhereHas('movie', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%' . $request . '%')
                    ->orWhere('tag_id', 'like', '%' . $request . '%');
            })
            
            ->orWhere('id', 'like', $request)
            ->orWhere('date', 'like', $dateFormat)
            ->get();
    }
}
