<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormEditMovies;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Requests\ValidateFormMoviesCreate;
use App\Models\Classification;
use App\Models\Tag;

class MovieController extends Controller
{
    public function index()
    {

        $movies = Movie::getAll();

        return view('movies.index', ['movies' => $movies]);
    }


    public function create()
    {
        $tags = Tag::all();
        $classifications = Classification::all();

        return view('movies.create', [
            'tags' => $tags,
            'classifications' => $classifications
        ]);
    }

    public function store(ValidateFormMoviesCreate $request)
    {
        $response = Movie::store($request);

        if ($response) {

            return back()->withInput()->with('msg-error', 'Filme já cadastrado');
        } else return redirect('/movies');
    }

    public function edit($id)
    {
        $movies = Movie::where('id', $id)->first();

        if (!empty($movies)) {

            $tags = Tag::all();
            $classifications = Classification::all();

            return view('movies.edit', [
                'classifications' => $classifications,
                'tags' => $tags,
                'movies' => $movies
            ]);

            return view('movies.edit', ['movies' => $movies]);
        } else {
            return redirect()->route('index');
        }
    }


    public function update(FormEditMovies $request, $id)
    {   
        
        $response = Movie::alter($request, $id);


        if ($response) {
            return back()->withInput()->with('msg-error', 'Filme já cadastrado');
        } else return redirect('/movies');
    }


    public function destroy($id)
    {
        try {
            Movie::destroy($id);

            return back()->with('msg-sucess', 'Filme apagado com sucesso!');
        } catch (\PDOException) {
            return back()->with('msg-error', 'Filme vinculado à uma sessão');
        }
    }
}
