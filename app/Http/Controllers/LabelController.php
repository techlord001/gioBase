<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LabelController extends Controller
{
    protected function validateData($command, $label)
    {   
        if ($command === 'update') {
            return request()->validate([
                'name' => 'required|unique:App\Label,name,' . $label->id,
                'description' => 'nullable',
                'location' => 'nullable',
                'image' => 'sometimes|file|image|max:2048'
            ]);
        } else {
            return request()->validate([
                'name' => 'required|unique:App\Label,name',
                'description' => 'nullable',
                'location' => 'nullable',
                'image' => 'sometimes|file|image|max:2048'
            ]);
        };
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

    protected function disassociate($children, $parent)
    {
        foreach ($children as $child) {
            $child->{$parent . "_id"} = null;
            $child->save();
        }
    }

    public function index()
    {
        $labels = Label::orderBy('name')->paginate(10);

        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store()
    {
        $label = Label::create($this->validateData(null, null));

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
        $oldImage = $label->image;

        $label->update($this->validateData('update', $label));

        $this->storeImage($label);

        if ($oldImage) {
            if ($oldImage !== $label->image) {
                unlink(storage_path('app/public/' . $oldImage));
            }
        }

        return redirect('/labels');
    }

    public function destroy(Label $label)
    {
        $this->disassociate($label->artists, 'label');

        if ($label->image) {
            unlink(storage_path('app/public/' . $label->image));
        }

        $label->delete();

        return redirect('/labels');
    }
}
