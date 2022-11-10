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
        $response = Classification::store($request);

        if ($response) {
            return back()->withInput()->with('msg-error', 'Classificação já existente');
        }
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

        $response = Classification::alter($request, $id);

        if ($response) {
            return back()->withInput()->with('msg-error', 'Classificação já cadastrada');
        }
        return redirect('/classifications');
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
