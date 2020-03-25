<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $guarded = [];

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

    public function colours()
    {
        return $this->belongsToMany(Colour::class, 'record_colour');
    }
}
