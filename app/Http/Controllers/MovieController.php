<?php

namespace App\Http\Controllers;

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
        try {
            Movie::store($request);

            return redirect('/movies')->with('msg-sucess', 'Filme cadastrado com sucesso!');
        } catch (\PDOException $e) {

            return back()->with('msg-error', "Algo inesperado ocorreu");
        }
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
        try {
            Movie::alter($request, $id);

            return redirect('/movies')->with('msg-sucess', 'Filme alterado com sucesso!');
        } catch (\PDOException) {
            return back()->with('msg-error', "Algo inesperado ocorreu");
        }
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
