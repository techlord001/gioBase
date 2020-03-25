<?php

namespace App\Http\Controllers;

use App\Record;
use App\Artist;
use App\Format;
use App\Colour;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class RecordController extends Controller
{
    protected function validateData()
    {
        return request()->validate([
            'title' => 'required',
            'artist_id' => 'required',
            'tracks' => 'nullable',
            'format_id' => 'nullable',
            'colour_id' => 'nullable',
            'released' => 'nullable',
            'cover' => 'sometimes|file|image|max:2048'
        ]);
    }

    protected function storeImage($record)
    {
        if (request()->has('cover')) {
            $record->update([
                'cover' => request()->cover->store('uploads', 'public')
            ]);

            $cover = Image::make(public_path('storage/' . $record->cover))->fit(200, 200);
            $cover->save();
        }
    }

    public function index()
    {
        $records = Record::all();

        return view('records.index', compact('records'));
    }

    public function create()
    {
        $artists = Artist::all();
        $formats = Format::all();
        $colours = Colour::all();

        return view('records.create', compact('artists', 'formats', 'colours'));
    }

    public function store()
    {
        $record = Record::create($this->validateData());
        
        $record->colours()->sync($record->colour_id);
        $this->storeImage($record);

        return redirect('/records/' . $record->id);
    }

    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    public function edit(Record $record)
    {
        $artists = Artist::all();
        $formats = Format::all();
        $colours = Colour::all();

        return view('records.edit', compact('record'), compact('artists', 'formats', 'colours'));
    }

    public function update(Record $record)
    {
        $record->update($this->validateData());

        $record->colours()->sync($record->colour_id);
        $this->storeImage($record);

        return redirect('/records');
    }

    public function destroy(Record $record)
    {
        $record->colours()->detach($record->colour_id);

        $record->delete();

        return redirect('/records');
    }
}
