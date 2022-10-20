<?php

namespace App\Models;

use App\Http\Requests\ValidateClassificationFormCreate;
use App\Services\CheckExistingItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }

    public static function getAll()
    {
        return Classification::all();
    }


    public static function store(ValidateClassificationFormCreate $request)
    {

        if (CheckExistingItems::classifications($request)) {
            return redirect('classifications/create')->with('msg-error', 'Classificação já existente');
        };

        $classifications = new Classification;

        $classifications->name = $request->name;

        $classifications->save();
    }


    public static function alter(ValidateClassificationFormCreate $request, $id)
    {
        if (CheckExistingItems::classifications($request)) {
            return redirect('classifications/create')->with('msg-error', 'Classificação já existente');
        };


        $data = [
            'name' => $request->name
        ];

        Classification::where('id', $id)->update($data);
    }


    public static function destroy($id)
    {
        $classifications = Classification::findOrFail($id);

        $classifications->delete();
    }
}
