<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();

        return view('rooms.index', ['rooms' => $rooms]);
    }

    public function create()
    {
        return view('rooms.create');
    }


    public function store(Request $request)
    {
        $rooms = new Room;

        $rooms->number = $request->number;

        $rooms->save();

        return redirect('/');
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

    public function destroy($id)
    {
        Room::where('id', $id)->delete();

        return redirect()->route('rooms-index');
    }
}
