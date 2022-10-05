<?php

namespace App\Models;


use App\Services\RoomsValidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateFormRoomsCreate;

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



    // Consultas no banco 

    public static function getAll()
    {
        return Room::all();
    }

    public static function store(ValidateFormRoomsCreate  $request)
    {   
    
        $rooms = new Room;

        $rooms->number = $request->number;

        $rooms->save();
    }

    public static function destroy($id)
    {

        $movie = Room::findOrFail($id);

        if (!$movie->sessions()->get()->isEmpty()) {
            return back()->with('msg-error', 'Sala vinculada à uma sessão');
        }

        try {

            $movie->delete();
        } catch (\PDOException) {
            return back()->with('msg-error', 'Sala vinculada à uma sessão');
        }
    }
}
