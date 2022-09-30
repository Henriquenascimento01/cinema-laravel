<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\ValideCineClosed;
use App\Services\RoomsValidate;
use App\Services\ValidatePastSessionDate;
use App\Http\Requests\ValidateFormSessionCreate;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time_initial',
        'time_finish',
        'movie_id',
        'room_id'

    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }



    public static function store(ValidateFormSessionCreate $request)
    {
        $request->validated();

        if (ValideCineClosed::cineClosed($request)) {
            return back()->with('msg ', 'Cinema fechado');
        }

        if (ValidatePastSessionDate::pastDate($request)) {

            return back()->withErrors('Data invalida');
        }

        if (RoomsValidate::usedRoom($request)) {
            return back()->withErrors('Data invalida');
        }



        $sessions = new Session;

        $sessions->date = $request->date;
        $sessions->time_initial = $request->time_initial;
        $sessions->time_finish = $request->time_finish;
        $sessions->room_id = $request->room_id;
        $sessions->movie_id = $request->movie_id;

        $sessions->save();
    }


    public static function alter($id, Request $request)
    {
        $data = [
            'date' => $request->date,
            'time' => $request->time,
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id

        ];

        Session::where('id', $id)->update($data);
    }

    public static function getSessionsWithMovies()
    {
        return Session::where('room_id');
    }
}
