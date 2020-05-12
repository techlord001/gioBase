<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'label_id',
        'homepage',
        'image'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function label()
    {
        return $this->belongsTo(Label::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
