<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::getAll();

        return view('rooms.index', ['rooms' => $rooms]);
    }

    public function create()
    {
        return view('rooms.create');
    }


    public function store(Request $request)
    {
        try {
            Room::store($request);

            return redirect('/rooms');
        } catch (\PDOException) {

            return back()->withErrors('Sala já existente');
        }
    }

    public function edit($id)
    {
        $rooms = Room::where('id', $id)->first();

        if (!empty($rooms)) {


            return view('rooms.edit', ['rooms' => $rooms]);
        } else {

            return redirect()->route('index');
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);

        $data = [
            'number' => $request->number
        ];

        Room::where('id', $id)->update($data);

        return redirect()->route('rooms-index');
    }

    public function destroy($id)
    {
        Room::destroy($id);

        return redirect()->route('rooms-index');
    }
}
