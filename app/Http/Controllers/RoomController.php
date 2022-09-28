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
        $return = Room::store($request);

        if ($return == true) {
            return redirect('/')->with('msg', 'Sala alterada com sucesso');
        } else return back()->withErrors('msg', $return);
    }

    public function edit($id)
    {
        $room = Room::where('id', $id)->get();

        if (!empty($room)) {
            return view('rooms.edit', ['room' => $room]);
        } else {
            return redirect()->route('index');
        }
    }

    public function update(Request $request, $number)
    {   
        //dd($request);
        Room::alter($number, $request);


        return redirect()->route('index');
    }

    public function destroy($id)
    {
        Room::where('id', $id)->delete();

        return redirect()->route('rooms-index');
    }
}
