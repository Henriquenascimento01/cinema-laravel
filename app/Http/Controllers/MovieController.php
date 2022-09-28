<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Cache\RedisTaggedCache;
use App\Models\Room;

class MovieController extends Controller
{

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {

        $movie = new Movie;

        $movie->name = $request->name;
        $movie->description = $request->description;

        $movie->save();

        return redirect('/');
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
        Movie::where('id', $id)->delete();

        return redirect()->route('index');
    }
}
