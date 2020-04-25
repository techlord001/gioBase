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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $records = User::find(Auth::user()->id)->records()->orderBy('name')->paginate(10);

        return view('home', compact('records'));
    }    

    public function store(Record $record, User $user)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->records()->syncWithoutDetaching($record->id);
        
        return redirect('/records/');
    }

    public function destroy(Record $record, User $user)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->records()->detach($record->id);
        
        return redirect('/home/');
    }
}
