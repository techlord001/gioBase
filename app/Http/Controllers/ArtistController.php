<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Label;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ArtistController extends Controller
{
    protected function validateData($command, $artist)
    {
        if ($command === 'update') {
            return request()->validate([
                'name' => 'required|unique:App\Artist,name,' . $artist->id,
                'description' => 'nullable',
                'label_id' => 'nullable',
                'image' => 'sometimes|file|image|max:2048'
            ]);
        } else {
            return request()->validate([
                'name' => 'required|unique:App\Artist,name',
                'description' => 'nullable',
                'label_id' => 'nullable',
                'image' => 'sometimes|file|image|max:2048'
            ]);
        }
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

        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        $labels = Label::all();

        return view('artists.create', compact('labels'));
    }

    public function store()
    {
        $artist = Artist::create($this->validateData(null, null));

        $artist->label()->associate(request('label_id'))->save();

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
        $oldImage = $artist->image;

        $artist->update($this->validateData('update', $artist));
        
        $artist->label()->associate(request('label_id'))->save();

        $this->storeImage($artist);

        if ($oldImage !== $artist->image) {
            unlink(storage_path('app/public/' . $oldImage));
        }

        return redirect('/artists');
    }

    public function destroy(Artist $artist)
    {
        $artist->records()->delete();

        if ($artist->image) {
            unlink(storage_path('app/public/' . $artist->image));
        }

        $artist->delete();

        return redirect('/artists');
    }
}
