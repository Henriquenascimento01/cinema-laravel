<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Cache\RedisTaggedCache;
use App\Models\Room;

class MovieController extends Controller
{
    public function index()
    {

        $movies = Movie::geAll();

        return view('movies.index', ['movies' => $movies]);
    }


    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {

        $movies = new Movie;

        $movies->name = $request->name;
        $movies->description = $request->description;

        $movies->save();

        //return view('movies.index');

        return redirect('/movies');
    }

    public function edit($id)
    {
        $movies = Movie::where('id', $id)->first();

        if (!empty($movies)) {
            return view('movies.edit', ['movies' => $movies]);
        } else {
            return redirect()->route('index');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            // incluir campos faltantes
        ];

        Movie::where('id', $id)->update($data);

        return redirect()->route('index');
    }

    public function destroy($id)
    {
        Movie::destroy($id);

        return redirect()->route('movies-index');
    }
}
