@extends('layouts.app')

@php
    $titleExt = " | ";

    switch (Request::url()) {
        case (Request::is('labels/*')):
            $titleExt .= $label->name;
            break;
        case (Request::is('artists/*')):
            $titleExt .= $artist->name;
            break;
        case (Request::is('records/*')):
            $titleExt .= $record->name;
            break;
        case (Request::is('collectors/*')):
            $titleExt .= $user->name;
            break;
        case (Request::is('home/profile')):
            $titleExt .= "My Profile";
            break;
        default:
            $titleExt .= "Vaporwave Database";
            break;
    }
@endphp

@section('content')
    <div class="container gbCard p-5">
        {{-- ******************** HEADER BUTTON LAYOUT ******************** 
                /
                /
                /   Buttons to link to index pages, back buttons,
                /   or add to/remove from personal lists 
                /
                / 
                /   ******************** ******************** --}}
        <div class="row justify-content-between">
            <div class="col-3">
                <a href="{{ $url }}">
                    <button class="btn btn-outline-info btn-sm"><< {{ $section }}</button>
                </a>
            </div>
            <div class="col-3 text-right">
                {{-- ******************** ADD TO/REMOVE FROM COLLECTION BUTTON ******************** --}}
                @auth                    
                    @if (Request::is('records/*'))
                        @php
                            $inWishlist = "";
                            $inCollection = "";

                            foreach ($userRecords as $userRecord) {
                                if ($userRecord->id === $record->id) {
                                    if ($userRecord->pivot->wishlist == true) {
                                        $inWishlist = true;
                                    } elseif ($userRecord->pivot->wishlist == false) {
                                        $inCollection = true;
                                    }
                                    break;
                                } else {
                                    $inWishlist = false;
                                    $inCollection = false;
                                }
                            }
                        @endphp
                        @if (!$inCollection && !$inWishlist)
                            <form action="/home/wishlist/{{ $record->id }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-info btn-sm my-2">Add to Wishlist</button>
                            </form>
                            <form action="/home/collection/{{ $record->id }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-info btn-sm my-2">Add to Collection</button>
                            </form>
                        @else
                            @if ($inWishlist)
                                <form action="/home/{{ $record->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm my-2">Remove from Wishlist</button>
                                </form>
                                <form action="/home/collection/{{ $record->id }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info btn-sm my-2">Add to Collection</button>
                                </form>                            
                            @endif
                            @if ($inCollection)
                                <form action="/home/wishlist/{{ $record->id }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info btn-sm my-2">Add to Wishlist</button>
                                </form>
                                <form action="/home/{{ $record->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm my-2">Remove from Collection</button>
                                </form>                            
                            @endif
                        @endif
                    @endif
                @endauth
            </div>
        </div>
        {{-- ******************** TOP LAYOUT ******************** 
                /
                /
                /   Displays name, bio, and/or homepage link 
                /
                / 
                /   ******************** ******************** --}}
        <div class="row justify-content-center mt-3">
            <div class="col-5">
                <h1>{{ $name }}</h1>
                @if (Request::is('collectors/*', 'home/profile'))
                    <h5>{{ $user->role->role }}</h5>
                @endif
                @if (Request::is('artists/*') && $artist->label_id)
                    <h4><a href="/labels/{{ $artist->label->id }}">{{ $artist->label->name }}</a></h4>
                @endif
                @if (Request::is('labels/*', 'artists/*'))
                    @if ($description)
                        <p class="lead">{{ $description }}</p>
                    @else
                        <p class="lead text-muted">No description!</p>
                    @endif
                @endif
                @if (isset($homepage))
                    <a href="{{ $homepage }}" target="_blank" rel="noopener noreferrer">
                        <button class="btn btn-outline-info">Homepage</button>
                    </a>
                @endif
            </div>
            <div class="col-5 text-right">
                @if ($image)
                    <img src="{{ asset('storage/' . $image) }}" alt="">
                @endif
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            {{-- ******************** MIDDLE LAYOUT ******************** 
                /
                /
                /   Display lists relevant to each page 
                /   e.g. for a Label page will list all associated artists
                /
                / 
                /   ******************** ******************** --}}
            @switch(Request::url())
                {{-- ******************** LABELS MIDDLE LAYOUT ******************** --}}
                @case(Request::is('labels/*'))
                    <div class="col-5">
                        <h3>Artists</h3>
                        <div class="list-group list-group-flush">
                            @forelse ($label->artists as $artist)
                                <a href="/artists/{{ $artist->id }}" class="list-group-item list-group-item-action">{{ $artist->name }}</a>
                            @empty
                                <p class="list-group-item text-muted">No artists signed!</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-5 text-right">
                        <h3>Records</h3>
                        <div class="list-group list-group-flush">
                            @forelse ($label->artists as $artist)
                                @foreach ($artist->records as $record)
                                    <a href="/records/{{ $record->id }}" class="list-group-item list-group-item-action">{{ $record->name }}</a>
                                @endforeach
                            @empty
                                <p class="list-group-item text-muted">No records made!</p>
                            @endforelse
                        </div>
                    </div>                   
                    @break
                {{-- ******************** ARTISTS MIDDLE LAYOUT ******************** --}}
                @case(Request::is('artists/*'))
                    <div class="col-8">
                        <h3>Records</h3>
                        <div class="list-group list-group-flush">
                            @forelse ($artist->records as $record)
                                <a href="/records/{{ $record->id }}" class="list-group-item list-group-item-action">{{ $record->name }}</a>
                            @empty
                                <p class="list-group-item text-muted">No records made!</p>
                            @endforelse
                        </div>
                    </div>
                    @break
                {{-- ******************** RECORDS MIDDLE LAYOUT ******************** --}}
                @case(Request::is('records/*'))
                    <dl class="row">
                        <dt class="col-6 text-right">Artist</dt>
                        <dd class="col-6">
                            <a href="/artists/{{ $record->artist->id }}">
                                {{ $record->artist->name }}
                            </a>
                        </dd>

                        <dt class="col-6 text-right">Label</dt>
                        <dd class="col-6">
                            @if ($record->artist->label_id)
                                <a href="/labels/{{ $record->artist->label->id }}">
                                    {{ $record->artist->label->name }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                        
                        <dt class="col-6 text-right">Genre</dt>
                        <dd class="col-6">
                            @forelse ($record->genres as $genre)
                            <button type="button" class="btn btn-outline-success btn-sm my-1">
                                {{ $genre->genre }}
                            </button>
                            @empty
                                -
                            @endforelse
                        </dd>

                        <dt class="col-6 text-right">Format</dt>
                        <dd class="col-6">
                            @if ($record->format_id)
                                {{ $record->format->format }}
                            @else
                                -
                            @endif
                        </dd>

                        <dt class="col-6 text-right">Colour</dt>
                        <dd class="col-6">
                            @if ($record->colour_id)
                                {{ $record->colour->colour  }}
                            @else
                                -
                            @endif
                        </dd>
                        
                        <dt class="col-6 text-right">Released</dt>
                        <dd class="col-6">
                            @if ($record->released)
                                {{ date('jS M Y', strtotime($record->released)) }}
                            @else
                                -
                            @endif
                        </dd>
                    </dl>
                    @break
                {{-- ******************** COLLECTORS MIDDLE LAYOUT ******************** --}}
                @case(Request::is('collectors/*'))
                    <div class="col-8">
                        <h3>My Record Collection</h3>
                        <div class="list-group list-group-flush">
                            @forelse ($userRecords as $record)
                                <a href="/records/{{ $record->id }}" class="list-group-item list-group-item-action">{{ $record->name }}</a>
                            @empty
                                <p class="list-group-item text-muted">No records in collection!</p>
                            @endforelse
                        </div>
                    </div>
                    @break
                @default
                    
            @endswitch
        </div>
        {{-- ******************** BOTTOM LAYOUT ******************** 
            /
            /
            /   Display functional buttons to edit and/or delete 
            /   (based on role)
            /
            / 
            /   ******************** ******************** --}}
        @if (Request::is('collectors/*'))
            @auth
                @if (auth()->user()->hasRole('Contributor') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                    <div class="row justify-content-center mt-4">
                        <div class="col-4">
                            <a href="{{ $url . $id }}/edit">
                                <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button>
                            </a>
                        </div>
                    </div>
                @endif
            @endauth
            @can('delete', App\Record::class)
                <div class="row justify-content-center mt-4">
                    <div class="col-4">
                        <form action="{{ $url . $id }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
                        </form>
                    </div>
                </div>
            @endcan
        @else
            @if ((Auth::user()->id === $id && Request::is('home/profile')) || auth()->user()->hasRole('Master'))
                <div class="row justify-content-center mt-4">
                    <div class="col-4">
                        <a href="/collectors/{{ $id }}/edit">
                            <button type="button" class="btn btn-primary btn-lg btn-block">Edit Profile</button>
                        </a>
                    </div>
                </div>
            @endif
        @can('delete', App\User::class)
            <div class="row justify-content-center mt-4">
                <div class="col-4">
                    <form action="{{ $url . $id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg btn-block">Delete Account</button>
                    </form>
                </div>
            </div>
        @endcan
        @endif
    </div>
@endsection