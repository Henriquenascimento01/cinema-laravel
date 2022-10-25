<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Session;
use App\Http\Requests\ValidateFormSessionCreate;


class SessionController extends Controller
{
    public function index()
    {
        return view('sessions.index');
    }

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
        $response = Session::store($request);

        if ($response) {

            return back()->with('msg-error', $response);
        } else return redirect('/');
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
        } else return redirect()->route('index');
    }


    public function update(ValidateFormSessionCreate $request, $id)
    {

        $response = Session::alter($request, $id);

        if ($response) {
            return back()->with('msg-error', $response);
        }
        return redirect('/')->with('msg-sucess', 'Sessão alterada com sucesso');
    }


    public function destroy($id)
    {
        try {
            Session::where('id', $id)->delete();

            return back()->with('msg-sucess', 'Sessão apagada com sucesso!');
        } catch (\PDOException) {

            return back()->with('msg-error', 'Ops, algo de inesperado ocorreu');
        }
    }
}
