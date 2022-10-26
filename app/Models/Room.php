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

        $messageError = CheckExistingItems::rooms($request);

        if ($messageError == false) {

            $rooms = new Room;

            $rooms->number = $request->number;

            $rooms->save();
        }
        return $messageError;
    }


    public static function alter(ValidateFormRoomsCreate $request, $id)
    {
        $messageError = CheckExistingItems::rooms($request);

        if ($messageError == false) {

            $data = [
                'number' => $request->number
            ];

            Room::where('id', $id)->update($data);
        }
        return $messageError;
    }


    public static function destroy($id)
    {
        $room = Room::findOrFail($id);

        $room->delete();
    }
}
