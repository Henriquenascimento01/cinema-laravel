<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateFormRoomsCreate;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateFormSessionCreate;
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

    public static function show($id)
    {
        $sessions = Session::findOrFail($id);

        return view('sessions.infos', [
            'sessions' => $sessions
        ]);
    }


    public function store(ValidateFormSessionCreate $request)
    {
        if ($request->room_id == "room_id" || $request->movie_id == "movie_id") {
            return back()->with('msg-error', 'Campos ID da sala e filme são obrigatórios');
        }

        try {
            Session::store($request);

            return redirect('/')->with('msg-sucess', 'Sessão criada com sucesso!');
        } catch (\PDOException) {

            return back()->withErrors('msg-error', 'Sala usada');
        }
    }


    public function edit($id)
    {

        $sessions = Session::where('id', $id)->first();


        if (!empty($sessions)) {

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

    public function update(ValidateFormSessionCreate $request, $id)
    {
        if ($request->room_id == "room_id" || $request->movie_id == "movie_id") {
            return back()->with('msg-error', 'Campos ID da sala e filme são obrigatórios');
        }

        try {
            Session::alter($request, $id);
            return redirect('/')->with('msg-sucess-edit', 'Sessão alterada com sucesso');
        } catch (\PDOException) {

            return back()->with('msg-error', 'Algo inesperado ocorreu');
        }
    }

    public function destroy($id)
    {
        Session::where('id', $id)->delete();

        return redirect()->route('index');
    }
}
