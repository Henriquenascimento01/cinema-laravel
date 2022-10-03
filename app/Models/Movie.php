<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        "tag",

    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


    public static function getSearchMovie()
    {
        $search = request('search');

        if ($search) {

            return Movie::where([
                ['name', 'like', '%' . $search . '%']
            ])->get();
        } else {

            Movie::getAll();
        }
    }

    public static function getAll()
    {


        return Movie::all();
    }

    // public static function alter(){

    // }

    public static function destroy($id)
    {

        $room = Movie::findOrFail($id);

        if (!$room->sessions()->get()->isEmpty()) {
            return back()->withErrors(['Sala vinculada à uma sessão']);
        }

        try {

            $room->delete();
        } catch (\PDOException) {
            return back()->withErrors('Sala vinculada à uma sessão');
        }
    }
}
