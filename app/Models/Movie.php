<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ValidateFormMoviesCreate;
use App\Services\ExistingMovies;

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


    // operações de crud de filmes, ( está em processo de refatoração )

    public static function getAll()
    {
        return Movie::all();
    }





    public static function store(ValidateFormMoviesCreate $request)
    {

        if (ExistingMovies::checkRepeated($request)) {
            return back()->with('msg-error', 'Filme já cadastrado');
        }

        $movies = new Movie;

        $movies->name = $request->name;
        $movies->description = $request->description;
        $movies->tag = $request->tag;

        $movies->save();
    }

    public static function alter(ValidateFormMoviesCreate $request, $id)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'tag' => $request->tag

        ];

        Movie::where('id', $id)->update($data);
    }


    public static function destroy($id)
    {

        $room = Movie::findOrFail($id);

        if (!$room->sessions()->get()->isEmpty()) {
            return back()->with('msg-error', 'Filme vinculado à uma sessão');
        }

        try {

            $room->delete();
        } catch (\PDOException) {
            return back()->with('msg-error', 'Filme vinculado à uma sessão');
        }
    }
}
