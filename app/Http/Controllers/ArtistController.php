<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Label;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ArtistController extends Controller
{
    protected function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'history' => 'nullable',
            'label_id' => 'nullable',
            'image' => 'sometimes|file|image|max:2048'
        ]);
    }

    protected function storeImage($artist)
    {
        if (request()->has('image')) {
            $artist->update([
                'image' => request()->image->store('uploads', 'public')
            ]);

            $image = Image::make(public_path('storage/' . $artist->image))->fit(200, 200);
            $image->save();
        }
    }

    public function index()
    {
        $artists = Artist::all();

        return view('artists.index', [
            'artists' => $artists
        ]);
    }

    public function create()
    {
        $labels = Label::all();

        return view('artists.create', compact('labels'));
    }

    public function store()
    {
        $artist = Artist::create($this->validateData());

        $this->storeImage($artist);

        return redirect('/artists/' . $artist->id);
    }

    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        $labels = Label::all();

        return view('artists.edit', compact('artist'), compact('labels'));
    }

    public function update(Artist $artist)
    {
        $artist->update($this->validateData());

        $this->storeImage($artist);

        return redirect('/artists');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect('/artists');
    }
}
