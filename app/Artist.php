<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [];

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}
