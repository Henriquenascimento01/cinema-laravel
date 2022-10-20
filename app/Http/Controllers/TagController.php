<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateTagsFormCreate;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::getAll();

        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(ValidateTagsFormCreate $request)
    {
        Tag::store($request);

        return redirect('/tags');
    }

    public function edit($id)
    {
        $tags = Tag::where('id', $id)->first();

        if (!empty($tags)) {


            return view('tags.edit', ['tags' => $tags]);
        } else {

            return redirect()->route('index');
        }
    }

    public function update(ValidateTagsFormCreate $request, $id)
    {
        //try {
        Tag::alter($request, $id);

        return redirect('/tags');
        // } catch (\PDOException $e) {

        //     if ($e->getCode() == 23000) {

        //         return back()->with('msg-error', 'A sala já existe');
        //     }
        //     if ($e->getCode() == "HY000") {

        //         return back()->with('msg-error', 'Por favor insira somente números');
        //     } else {

        //         return back()->with('msg-error', 'Erro ao atualizar a sala');
        //     }
        // }
    }

    public function destroy($id)
    {
        try {
            Tag::destroy($id);

            return redirect('/tags');
        } catch (\PDOException) {

            return back()->with('msg-error', 'Gênero vinculado à um filme');
        }
    }
}
