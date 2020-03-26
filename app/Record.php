<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name',
        'artist_id',
        'format_id',
        'colour_id',
        'released',
        'image'
    ];

    protected $casts = [
        'colour_id' => 'array'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    public function colour()
    {
        return $this->belongsTo(Colour::class);
    }
}
