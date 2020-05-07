@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="list-group" role="tablist">
                    @forelse ($genres as $genre)
                        <a href="{{ '#genre' . $genre->id }}" class="list-group-item list-group-item-action gbListGroup-item"data-toggle="list" role="tab">
                            {{ $genre->genre }}
                        </a>
                    @empty                        
                        <a href="" class="list-group-item list-group-item-action" data-toggle="list" role="tab">
                            No genres!
                        </a>
                    @endforelse
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content h-100 row align-items-center justify-content-center gbListGroup-content rounded">
                    @foreach ($genres as $genre)
                        <div class="tab-pane fade px-3 container" role="tabpanel" id="{{ 'genre' . $genre->id }}">
                            <div class="row justify-content-center">
                                <h3>{{ $genre->genre }}</h3>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                @if (isset($genre->description))
                                    <p class="px-4">{{ $genre->description }}</p>
                                @else
                                <p class="text-center"> - </p>
                                @endif
                            </div>
                            @auth
                                @if (Auth::user()->hasRole('Master', 'Admin'))
                                <div class="row justify-content-around">
                                    <div class="col-4 text-center">
                                        <a href="/genres/{{ $genre->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm mx-1" title="Edit">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>                                                    
                                                </span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <form action="/genres/{{ $genre->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                                <span class="icon">
                                                    <i class="fas fa-trash-alt"></i>                                                    
                                                </span>
                                            </button>
                                        </form>                                        
                                    </div>
                                </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection