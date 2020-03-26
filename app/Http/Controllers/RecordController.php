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
            'name' => 'required',
            'artist_id' => 'required',
            'format_id' => 'nullable',
            'colour_id' => 'nullable',
            'released' => 'nullable',
            'image' => 'sometimes|file|image|max:2048'
        ]);
    }

    protected function storeImage($record)
    {
        if (request()->has('image')) {
            $record->update([
                'image' => request()->image->store('uploads', 'public')
            ]);

            $image = Image::make(public_path('storage/' . $record->image))->fit(200, 200);
            $image->save();
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
        $oldImage = $record->image;

        $record->update($this->validateData());

        $this->storeImage($record);

        if ($oldImage !== $record->image) {
            unlink(storage_path('app/public/' . $oldImage));
        }

        return redirect('/records');
    }

    public function destroy(Record $record)
    {
        if ($record->image) {
            unlink(storage_path('app/public/' . $record->image));
        }

        $record->delete();

        return redirect('/records');
    }
}
