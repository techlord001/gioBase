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

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
