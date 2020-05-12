<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Label extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'location',
        'description',
        'homepage',
        'image'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
