<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public static function store(Request $request)
    {
        try {
            $rooms = new Room;

            $rooms->number = $request->number;

            $rooms->save();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function alter($number, Request $request)
    {
        
        $data = [
            'number' => $request->number
        ];

        Room::where('number', $number)->update($data);
    }
}
