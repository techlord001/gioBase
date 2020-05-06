<?php

namespace App\Http\Controllers;

use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $records = User::select('id', 'name')->find(Auth::user()->id)->records()->orderBy('name')->paginate(10);

        return redirect('home/profile');
    }

    public function profileIndex()
    {
        $user = User::select('id', 'name', 'image', 'role_id')->find(Auth::user()->id);
        
        return view('collector.profile.index', compact('user'));
    }

    public function collectionIndex()
    {
        $records = User::select('id', 'name')->find(Auth::user()->id)->records()->where('wishlist', 0)->orderBy('name')->paginate(10);

        return view('collector.collection.index', compact('records'));
    } 

    public function wishlistIndex()
    {
        $records = User::select('id', 'name')->find(Auth::user()->id)->records()->where('wishlist', 1)->orderBy('name')->paginate(10);

        return view('collector.wishlist.index', compact('records'));
    }    

    // public function store(Record $record, User $user)
    // {
    //     $user = User::select('id', 'name')->findOrFail(Auth::user()->id);

    //     $user->records()->syncWithoutDetaching([$record->id => [ 'wishlist' => true ]]);
        
    //     return redirect('/records/');
    // }

    public function collectionStore(Record $record, User $user)
    {
        $user = User::select('id', 'name')->findOrFail(Auth::user()->id);

        $user->records()->syncWithoutDetaching([$record->id => [ 'wishlist' => false ]]);
        
        return redirect()->back();
    }

    public function wishlistStore(Record $record, User $user)
    {
        $user = User::select('id', 'name')->findOrFail(Auth::user()->id);

        $user->records()->syncWithoutDetaching([$record->id => [ 'wishlist' => true ]]);
        
        return redirect()->back();
    }

    public function destroy(Record $record, User $user)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->records()->detach($record->id);
        
        return redirect()->back();
    }
}
