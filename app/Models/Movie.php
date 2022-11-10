<?php

namespace App\Models;

use App\Http\Requests\FormEditMovies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ValidateFormMoviesCreate;
use App\Services\CheckExistingItems;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'imagem',
        'classification_id',
        'tag_id'
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }


    // operações de crud de filmes, ( está em processo de refatoração )

    public static function getAll()
    {
        return Movie::all();
    }


    public static function store(ValidateFormMoviesCreate $request)
    {
        $messageError = CheckExistingItems::movies($request);

        if ($messageError == false) {

            $movies = new Movie;

            $movies->name = $request->name;
            $movies->description = $request->description;
            $movies->classification_id = $request->classification_id;
            $movies->tag_id = $request->tag_id;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/movies'), $imageName);

                $movies->image = $imageName;
            }

            $movies->save();
        }
        return $messageError;
    }



    public static function alter(FormEditMovies $request, $id)
    {
        $messageError = CheckExistingItems::moviesUpdate($request);

        if ($messageError == false) {

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'tag_id' => $request->tag_id,
                'classification_id' => $request->classification_id

            ];

            if ($request->hasFile('image')) {

                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/movies'), $imageName);

                $data['image'] = $imageName;
            }

            Movie::where('id', $id)->update($data);
        }
        return $messageError;
    }


    public static function destroy($id)
    {

        $movie = Movie::findOrFail($id);

        $movie->delete();
    }
}
