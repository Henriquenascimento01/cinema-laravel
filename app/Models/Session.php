<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\RoomsValidate;
use App\Services\ValidatePastSessionDate;
use App\Services\ValidateCineOpened;
use App\Http\Requests\ValidateFormSessionCreate;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time_initial',
        'time_finish',
        'movie_id',
        'room_id',
        'image'
    ];

    // protected $guarded = [];

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


        if (!ValidateCineOpened::cineOpened($request)) {
            return back()->withErrors('msg-error', 'Cinema fechado');
        }

        if (ValidatePastSessionDate::pastDate($request)) {

            return back()->withErrors('msg-error', 'Data invalida');
        }

        // if (RoomsValidate::usedRoom($request)) {
        //     return back()->withErrors('Data invalida');
        // }

        $sessions = new Session;

        $sessions->date = $request->date;
        $sessions->time_initial = $request->time_initial;
        $sessions->time_finish = $request->time_finish;
        $sessions->room_id = $request->room_id;
        $sessions->movie_id = $request->movie_id;


        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/movies'), $imageName);

            $sessions->image = $imageName;
        }


        $sessions->save();
    }


    public static function alter(ValidateFormSessionCreate $request, $id)
    {

        if (!ValidateCineOpened::cineOpened($request)) {

            return back()->withErrors('msg', 'Cinema fechado');
        }

        if (ValidatePastSessionDate::pastDate($request)) {

            return back()->withErrors('msg', 'Data invalida');
        }

        // if(RoomsValidate::usedRoom())

        $data = [
            'date' => $request->date,
            'time_initial' => $request->time_initial,
            'time_finish' => $request->time_finish,
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'image' => $request->image
        ];

        if ($request->hasFile('image')) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/movies'), $imageName);

            $data['image'] = $imageName;
        }

        Session::where('id', $id)->update($data);
    }


    public static function getSessionsWithMovies()
    {
        return Session::with('sessions', 'room')
            ->orderBy('date')->orderBy('time')
            ->get();
    }
}
