<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    protected $fillable = ['colour'];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
