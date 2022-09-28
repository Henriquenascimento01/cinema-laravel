<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

        try {
            $sessions = new Session;

            $sessions->date = $request->date;
            $sessions->time = $request->time;
            $sessions->room_id = $request->room_id;
            $sessions->movie_id = $request->movie_id;

            $sessions->save();

            return true;
        } catch (\PDOException $e) {

            return $e->getMessage();
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

    
}
