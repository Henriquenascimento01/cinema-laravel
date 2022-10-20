<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Http\Request;
use App\Services\RoomsValidate;
use App\Services\ValidatePastSessionDate;
use App\Services\ValidateCineOpened;
use App\Http\Requests\ValidateFormSessionCreate;
use App\Services\RoomsWithSessionsOrdered;
use Illuminate\Database\Eloquent\Model;
use App\Services\ValidateSessionDate;
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
        //dd(RoomsWithSessionsOrdered::get()); 

        $messageError = ValidationServices::validAll($request);

       // dd($messageError); 

        if ($messageError === false) {

            $sessions = new Session;

            $sessions->date = $request->date;
            $sessions->time_initial = $request->time_initial;
            $sessions->time_finish = $request->time_finish;
            $sessions->room_id = $request->room_id;
            $sessions->movie_id = $request->movie_id;

            $sessions->save();
        }   return $messageError; 
    }


    public static function alter(ValidateFormSessionCreate $request, $id)
    {


        if (ValidationServices::validAll($request)) {
            return redirect('/sessions/create');
        }


        $data = [
            'date' => $request->date,
            'time_initial' => $request->time_initial,
            'time_finish' => $request->time_finish,
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,

        ];

        Session::where('id', $id)->update($data);
    }
}
