<?php

namespace App\Http\Controllers;

use App\Colour;
use Illuminate\Http\Request;

class ColourController extends Controller
{
    protected function validateData($command, $colour)
    {
        if ($command === 'update') {
            return request()->validate([
                'colour' => 'required|unique:App\Colour,colour,' . $colour->id
            ]);
        } else {
            return request()->validate([
                'colour' => 'required|unique:App\Colour,colour'
            ]);            
        }
    }

    public function index()
    {
        $colours = Colour::orderBy('colour')->get();

        return view('colours.index', compact('colours'));
    }

    public function create()
    {
        return view('colours.create');
    }

    public function store()
    {
        Colour::create($this->validateData(null, null));

        return redirect('/colours/');
    }

    public function edit(Colour $colour)
    {
        return view('colours.edit', compact('colour'));
    }

    public function update(Colour $colour)
    {
        $colour->update($this->validateData('update', $colour));

        return redirect('/colours');
    }

    public function destroy(Colour $colour)
    {
        foreach ($colour->records as $record) {
            $record->colour_id = NULL;
            $record->save();
        }

        $colour->delete();

        return redirect('/colours');
    }
}
