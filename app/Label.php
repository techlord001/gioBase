<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
