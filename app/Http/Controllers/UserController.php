<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    protected function validateData($user)
    {
        return request()->validate([
            'name' => 'required|unique:App\User,name,' . $user->id,
            'image' => 'sometimes|file|image|max:2048'
        ]);
    }

    protected function storeImage($user)
    {
        if (request()->has('image')) {
            $user->update([
                'image' => request()->image->store('uploads', 'public')
            ]);

            $image = Image::make(public_path('storage/' . $user->image))->fit(200, 200);
            $image->save();
        }
    }

    public function index()
    {
        $this->authorize('view', User::class);

        $users = User::select('id', 'name', 'image', 'role_id')->with('records')->orderBy('name')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user = User::select('id', 'name', 'image', 'role_id')->with('records')->find($user->id);
        
        if (Auth::user()) {
            $userRecords = User::find(Auth::user()->id)->records()->get();
            return view('users.show', compact('user'), compact('userRecords'));
        } else {
            return view('users.show', compact('user'));
        }
    }

    public function edit(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return abort(403);
        }
    }

    public function update(User $user)
    {
        if (Auth::user()->id === $user->id) {
            $oldImage = $user->image;
    
            $user->update($this->validateData($user));
    
            $this->storeImage($user);
    
            if ($oldImage) {
                if ($oldImage !== $user->image) {
                    unlink(storage_path('app/public/' . $oldImage));
                }
            }
    
            return redirect('/users/' . $user->id);
        } else {
            return abort(403);
        }
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        if ($user->image) {
            unlink(storage_path('app/public/' . $user->image));
        }

        $user->delete();

        return redirect('/users');
    }
}
