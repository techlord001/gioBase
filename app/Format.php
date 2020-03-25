<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $fillable = ['format'];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
