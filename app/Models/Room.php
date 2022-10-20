<?php

namespace App\Models;


use App\Services\RoomsValidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateFormRoomsCreate;
use App\Services\CheckExistingItems;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        "number"
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }



    public static function getAll()
    {
        return Room::all();
    }


    public static function store(ValidateFormRoomsCreate $request)
    {
        if (CheckExistingItems::rooms($request)) {

            return back()->with('msg-error', 'Sala já existente');
        };

        $rooms = new Room;

        $rooms->number = $request->number;

        $rooms->save();
    }


    public static function alter(ValidateFormRoomsCreate $request, $id)
    {
        if (CheckExistingItems::rooms($request)) {

            return back()->with('msg-error', 'Sala já existente');
        };


        $data = [
            'number' => $request->number
        ];

        Room::where('id', $id)->update($data);
    }


    public static function destroy($id)
    {
        $room = Room::findOrFail($id);

        $room->delete();
    }
}
