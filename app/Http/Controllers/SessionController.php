<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{

    public function create()
    {
        $movies = Movie::all();
        $rooms = Room::all();

        return view('sessions.create', [
            'rooms' => $rooms,
            'movies' => $movies
        ]);
    }

    public function store(Request $request)
    {
        $sessions = new Session;

        $sessions->date = $request->date;
        $sessions->time = $request->time;
        $sessions->room_id = $request->room_id;
        $sessions->movie_id = $request->movie_id;

        $sessions->save();

        return redirect('/');
    }


    public function edit($id)
    {

        $sessions = Session::where('id', $id)->first();


        if (!empty($sessions)) {
            //dd($sessions);
            $movies = Movie::all();
            $rooms = Room::all();

            return view('sessions.edit', [
                'sessions' => $sessions,
                'rooms' => $rooms,
                'movies' => $movies
            ]);
        } else {

            return redirect()->route('index');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'date' => $request->date,
            'time' => $request->time,
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id
            
        ];

        Session::where('id', $id)->update($data);

        return redirect()->route('index');
    }

    public function destroy($id)
    {
        Session::where('id', $id)->delete();

        return redirect()->route('index');
    }
}
