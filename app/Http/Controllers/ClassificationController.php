<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateClassificationFormCreate;
use App\Models\Classification;

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = Classification::getAll();

        return view('classifications.index', ['classifications' => $classifications]);
    }

    public function create()
    {
        return view('classifications.create');
    }

    public function store(ValidateClassificationFormCreate $request)
    {
        Classification::store($request);

        return redirect('/classifications');
    }

    public function edit($id)
    {
        $classifications = Classification::where('id', $id)->first();

        if (!empty($classifications)) {


            return view('classifications.edit', ['classifications' => $classifications]);
        } else {

            return redirect()->route('index');
        }
    }

    public function update(ValidateClassificationFormCreate $request, $id)
    {
        try {
            Classification::alter($request, $id);

            return redirect('/classifications');
        } catch (\PDOException) {
            return back()->with('msg-error', 'Erro ao atualiza classificação');
        }
    }

    public function destroy($id)
    {
        try {
            Classification::destroy($id);

            return redirect('/classifications');
        } catch (\PDOException) {

            return back()->with('msg-error', 'Classificação vinculada à um filme');
        }
    }
}
