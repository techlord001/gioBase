<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description',
        'homepage',
        'image'
    ];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
