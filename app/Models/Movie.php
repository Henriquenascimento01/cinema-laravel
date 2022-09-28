<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image",

    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }

}
