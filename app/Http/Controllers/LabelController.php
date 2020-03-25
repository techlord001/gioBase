<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LabelController extends Controller
{
    protected function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'nullable',
            'artist_id' => 'nullable',
            'image' => 'sometimes|file|image|max:2048'
        ]);
    }

    protected function storeImage($label)
    {
        if (request()->has('image')) {
            $label->update([
                'image' => request()->image->store('uploads', 'public')
            ]);

            $image = Image::make(public_path('storage/' . $label->image))->fit(200, 200);
            $image->save();
        }
    }

    public function index()
    {
        $labels = Label::all();

        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store()
    {
        $label = Label::create($this->validateData());

        $this->storeImage($label);

        return redirect('/labels/' . $label->id);
    }

    public function show(Label $label)
    {
        return view('labels.show', compact('label'));
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Label $label)
    {
        $label->update($this->validateData());

        $this->storeImage($label);

        return redirect('/labels');
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return redirect('/labels');
    }
}
