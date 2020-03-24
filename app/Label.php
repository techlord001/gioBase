<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function artist()
    {
        return $this->hasMany(Artist::class);
    }
}
