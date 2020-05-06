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
        $this->authorize('view', Colour::class);

        $colours = Colour::orderBy('colour')->get();

        return view('colours.index', compact('colours'));
    }

    public function create()
    {
        $this->authorize('create', Colour::class);

        return view('colours.create');
    }

    public function store()
    {
        $this->authorize('create', Colour::class);

        Colour::create($this->validateData(null, null));

        return redirect('/colours/');
    }

    public function edit(Colour $colour)
    {
        $this->authorize('update', Colour::class);

        return view('colours.edit', compact('colour'));
    }

    public function update(Colour $colour)
    {
        $this->authorize('update', Colour::class);

        $colour->update($this->validateData('update', $colour));

        return redirect('/colours');
    }

    public function destroy(Colour $colour)
    {
        $this->authorize('delete', Colour::class);

        foreach ($colour->records as $record) {
            $record->colour_id = NULL;
            $record->save();
        }

        $colour->delete();

        return redirect('/colours');
    }
}
