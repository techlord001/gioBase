<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Record extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'artist_id',
        'label_id',
        'format_id',
        'colour_id',
        'released',
        'homepage',
        'image'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    public function colour()
    {
        return $this->belongsTo(Colour::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
