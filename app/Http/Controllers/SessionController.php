<?php

namespace App\Http\Controllers;

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

    public function store(ValidateFormSessionCreate $request)
    {

        $request->validated();
        //dd($request);
        try {
            Session::store($request);

            return redirect('/')->with('msg', 'Sessão criada com sucesso!');
        } catch (\PDOException $e) {

            return $e->getMessage();
        }
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

    public function update(ValidateFormSessionCreate $request, $id)
    {
        Session::alter($id, $request);

        return redirect()->route('index');
    }

    public function destroy($id)
    {
        Session::where('id', $id)->delete();

        return redirect()->route('index');
    }
}
