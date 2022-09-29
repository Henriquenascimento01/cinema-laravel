<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\ValideCineClosed;
use DateTime;
use DateTimeZone;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
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

    public static function store(Request $request)
    {
        // dd($request);
        $hourOpening = date("Y-m-d 10:00");
        $hourClosed  = date("Y-m-d 23:00");

        $session = new DateTime($request->date . $request->time_initial, new DateTimeZone('America/Sao_Paulo'));

        if ($session < $hourOpening || $session > $hourClosed) {
            return back()->withErrors('error');
        } else {


            try {
                $sessions = new Session;

                $sessions->date = $request->date;
                $sessions->time_initial = $request->time_initial;
                $sessions->time_finish = $request->time_finish;
                $sessions->room_id = $request->room_id;
                $sessions->movie_id = $request->movie_id;

                $sessions->save();

                return true;
            } catch (\PDOException $e) {

                return $e->getMessage();
            }
        }
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
        return Session::with('movie', 'room')
            ->orderBy('date')->orderBy('time')
            ->get();
    }
}
