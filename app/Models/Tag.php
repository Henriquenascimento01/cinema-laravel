<?php

namespace App\Models;

use App\Http\Requests\ValidateTagsFormCreate;
use App\Services\CheckExistingItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasOne(Movie::class);
    }

    public static function getAll()
    {
        return Tag::all();
    }


    public static function store(ValidateTagsFormCreate $request)
    {
        if (CheckExistingItems::tags($request)) {
            return back()->with('msg-error', 'Gênero já existente');
        };

        $tags = new Tag;

        $tags->name = $request->name;

        $tags->save();
    }


    public static function alter(ValidateTagsFormCreate $request, $id)
    {
        if (CheckExistingItems::tags($request)) {
            return back()->with('msg-error', 'Gênero já existente');
        };

        $data = [
            'name' => $request->name
        ];

        Tag::where('id', $id)->update($data);
    }


    public static function destroy($id)
    {
        $tags = Tag::findOrFail($id);

        $tags->delete();
    }
}
