<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\ValidateFormRoomsCreate;

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


    public function store(ValidateFormRoomsCreate $request)
    {
        $response = Room::store($request);

        if ($response) {
            return back()->withInput()->with('msg-error', 'Sala já cadastrada');
        } else return redirect('/rooms');
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

    public function update(ValidateFormRoomsCreate $request, $id)
    {

        $response = Room::alter($request, $id);

        if ($response) {
            return back()->withInput()->with('msg-error', 'Sala já cadastrada');
        }
        return redirect('/rooms');
    }


    public function destroy($id)
    {
        try {
            Room::destroy($id);

            return back()->with('msg-sucess', 'Sala apagada com sucesso');
        } catch (\PDOException) {

            return back()->with('msg-error', 'Sala vinculada à uma sessão');
        }
    }
}
