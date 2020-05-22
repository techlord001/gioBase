<?php

namespace App\Http\Controllers;

use App\Record;
use App\Artist;
use App\Format;
use App\Colour;
use App\Genre;
use App\Label;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecordController extends Controller
{
    protected function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'artist_id' => 'required',
            'label_id' => 'required',
            'genres' => 'nullable',
            'format_id' => 'nullable',
            'colour_id' => 'nullable',
            'released' => 'nullable|before_or_equal:' . Carbon::now(),
            'homepage' => 'nullable|url',
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
        $records = Record::with(['artist', 'label', 'genres', 'format', 'colour', 'users'])->orderBy('name')->paginate(10);

        if (Auth::user()) {
            $userRecords = User::select('id', 'name')->find(Auth::user()->id)->records()->get();
            return view('records.index', compact('records'), compact('userRecords'));
        } else {
            return view('records.index', compact('records'));
        }
    }

    public function create()
    {
        $this->authorize('create', Record::class);

        $artists = Artist::orderBy('name')->get();
        $labels = Label::orderBy('name')->get();
        $genres = Genre::orderBy('genre')->get();
        $formats = Format::orderBy('format')->get();
        $colours = Colour::orderBy('colour')->get();

        return view('records.create', compact('artists', 'labels', 'genres', 'formats', 'colours'));
    }

    public function store()
    {        
        $this->authorize('create', Record::class);
        
        $record = Record::create($this->validateData());

        $artist = Artist::findOrFail($record->artist_id);

        $artist->labels()->sync($record->label_id);
        
        $genres = request("genres");

        if ($genres) {
            $record->genres()->sync(array_keys($genres));
        }

        $this->storeImage($record);

        return redirect('/records/' . $record->id);
    }

    public function show(Record $record)
    {
        if (Auth::user()) {
            $userRecords = User::select('id', 'name')->find(Auth::user()->id)->records()->get();
            return view('records.show', compact('record'), compact('userRecords'));
        } else {
            return view('records.show', compact('record'));
        }
    }

    public function edit(Record $record)
    {
        $this->authorize('update', Record::class);

        $artists = Artist::orderBy('name')->get();
        $labels = Label::orderBy('name')->get();
        $genres = Genre::orderBy('genre')->get();
        $formats = Format::orderBy('format')->get();
        $colours = Colour::orderBy('colour')->get();

        return view('records.edit', compact('record'), compact('artists', 'labels', 'genres', 'formats', 'colours'));
    }

    public function update(Record $record)
    {
        $this->authorize('update', Record::class);

        $oldImage = $record->image;

        $record->update($this->validateData());
        
        $genres = request("genres");

        if (isset($genres)) {
            $record->genres()->sync(array_keys($genres));
        }

        $this->storeImage($record);

        if ($oldImage) {
            if ($oldImage !== $record->image) {
                unlink(storage_path('app/public/' . $oldImage));
            }
        }

        return redirect('/records');
    }

    public function destroy(Record $record)
    {
        $this->authorize('delete', Record::class);

        if ($record->image) {
            unlink(storage_path('app/public/' . $record->image));
        }

        $record->delete();

        return redirect('/records');
    }

    public function search()
    {    
        // dd($search);

        // return $search;

        return view('records.search');
    }

    public function searchResults(Request $query)
    {
        $query = request('query');

        $records = Record::search($query)->get();
        
        if (Auth::user()) {
            $userRecords = User::select('id', 'name')->find(Auth::user()->id)->records()->get();
            return view('records.search', compact('records'), compact('userRecords'));
        } else {
            return view('records.search', compact('records'));
        }
    }
}
