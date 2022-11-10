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
        $response =  Tag::store($request);

        if ($response) {

            return back()->withInput()->with('msg-error', 'Gênero já cadastrado');
        } else return redirect('/tags');
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
        $response = Tag::alter($request, $id);

        if ($response) {
            return back()->withInput()->with('msg-error', 'Gênero já cadastrado');
        }

        return redirect('/tags');
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
