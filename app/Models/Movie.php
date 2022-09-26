<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image",
        "tag"
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createMovie()
    {
        $movie = Movie::create(['name' => 'Inovocação']);

        return $movie->sessions()->get();
    }
}
