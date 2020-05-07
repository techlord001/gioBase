<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected function validateData($command, $genre)
    {   
        if ($command === 'update') {
            return request()->validate([
                'genre' => 'required|unique:App\Genre,genre,' . $genre->id,
                'description' => 'nullable'
            ]);
        } else {
            return request()->validate([
                'genre' => 'required|unique:App\Genre,genre',
                'description' => 'nullable'
            ]);
        };
    }

    public function index()
    {
        $genres = Genre::orderBy('genre')->get();
        
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        $this->authorize('create', Genre::class);

        return view('genres.create');
    }

    public function store()
    {
        $this->authorize('create', Genre::class);

        Genre::create($this->validateData(null, null));

        return redirect('/genres');
    }

    public function edit(Genre $genre)
    {
        $this->authorize('update', Genre::class);

        return view('genres.edit', compact('genre'));
    }

    public function update(Genre $genre)
    {
        $this->authorize('update', Genre::class);

        $genre->update($this->validateData('update', $genre));

        return redirect('/genres');
    }

    public function destroy(Genre $genre)
    {
        $this->authorize('delete', Genre::class);

        $genre->records()->detach();

        $genre->delete();

        return redirect('/genres');
    }
}
