<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();

        return view('movies.index', ['rooms' => $rooms]);
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
}
