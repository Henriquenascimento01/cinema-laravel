<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use App\Http\Requests\ValidateFormSessionCreate;
use Illuminate\Database\Eloquent\Model;
use App\Services\ValidationServices;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time_initial',
        'time_finish',
        'movie_id',
        'room_id',

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

        $messsageError = ValidationServices::validAll($request);

        if ($messsageError == false) {

            $sessions = new Session;

            $sessions->date = $request->date;
            $sessions->time_initial = $request->time_initial;
            $sessions->time_finish = $request->time_finish;
            $sessions->room_id = $request->room_id;
            $sessions->movie_id = $request->movie_id;


            $sessions->save();
        }
        return $messsageError;
    }


    public static function alter(ValidateFormSessionCreate $request, $id)
    {

        $messsageError = ValidationServices::validAll($request);

        if ($messsageError == false) {

            $data = [
                'date' => $request->date,
                'time_initial' => $request->time_initial,
                'time_finish' => $request->time_finish,
                'movie_id' => $request->movie_id,
                'room_id' => $request->room_id,


            ];

            Session::where('id', $id)->update($data);
        }
        return $messsageError;
    }
}
