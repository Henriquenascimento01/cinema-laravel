<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Cache\RedisTaggedCache;
use App\Models\Room;
use App\Http\Requests\ValidateFormMoviesCreate;

class MovieController extends Controller
{
    public function index()
    {
        $search = Movie::getSearchMovie();
        $movies = Movie::getAll();

        if (empty($search)) {

            return view('movies.index', ['movies' => $movies, 'search' => $search]);
        }

        return view('movies.index', ['movies' => $movies]);
    }


    public function create()
    {
        return view('movies.create');
    }

    public function store(ValidateFormMoviesCreate $request)
    {

        $movies = new Movie;

        $movies->name = $request->name;
        $movies->description = $request->description;
        $movies->tag = $request->tag;

        $movies->save();

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

    public function update(ValidateFormMoviesCreate $request, $id)
    {

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'tag' => $request->tag
            
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
