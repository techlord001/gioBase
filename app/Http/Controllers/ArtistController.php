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
                'homepage' => 'nullable|url',
                'image' => 'sometimes|file|image|max:2048'
            ]);
        } else {
            return request()->validate([
                'name' => 'required|unique:App\Artist,name',
                'description' => 'nullable',
                'label_id' => 'nullable',
                'homepage' => 'nullable|url',
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
        $artists = Artist::with('label', 'records')->orderBy('name')->paginate(10);

        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        $labels = Label::orderBy('name')->get();

        return view('artists.create', compact('labels'));
    }

    public function store()
    {
        $this->authorize('create', Artist::class);

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
        $this->authorize('update', Artist::class);

        $labels = Label::orderBy('name')->get();

        return view('artists.edit', compact('artist'), compact('labels'));
    }

    public function update(Artist $artist)
    {
        $this->authorize('update', Artist::class);

        $oldImage = $artist->image;

        $artist->update($this->validateData('update', $artist));
        
        $artist->label()->associate(request('label_id'))->save();

        $this->storeImage($artist);

        if ($oldImage) {
            if ($oldImage !== $artist->image) {
                unlink(storage_path('app/public/' . $oldImage));
            }
        }

        return redirect('/artists');
    }

    public function destroy(Artist $artist)
    {
        $this->authorize('delete', Artist::class);

        $artist->records()->delete();

        if ($artist->image) {
            unlink(storage_path('app/public/' . $artist->image));
        }

        $artist->delete();

        return redirect('/artists');
    }

    public function searchResults(Request $query)
    {
        $query = request('query');

        $artists = Artist::search($query)->get();

        return view('artists.search', compact('artists'));
    }
}
