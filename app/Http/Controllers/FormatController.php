<?php

namespace App\Http\Controllers;

use App\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    protected function validateData($command, $format)
    {
        if ($command === 'update') {
            return request()->validate([
                'format' => 'required|unique:App\Format,format,' . $format->id
            ]);
        } else {
            return request()->validate([
                'format' => 'required|unique:App\Format,format'
            ]);            
        }
    }

    public function index()
    {
        $formats = Format::orderBy('format')->get();

        return view('formats.index', compact('formats'));
    }

    public function create()
    {
        return view('formats.create');
    }

    public function store()
    {
        Format::create($this->validateData(null, null));

        return redirect('/formats/');
    }

    public function edit(Format $format)
    {   
        return view('formats.edit', compact('format'));
    }

    public function update(Format $format)
    {
        $format->update($this->validateData('update', $format));

        return redirect('/formats');
    }

    public function destroy(Format $format)
    {
        foreach ($format->records as $record) {
            $record->format_id = NULL;
            $record->save();
        }

        $format->delete();

        return redirect('/formats');
    }
}
