@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-3">
                <a href="{{ $url }}">
                    <button class="btn btn-outline-info btn-sm"><< {{ $section }}</button>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-5">
                <h1>{{ $name }}</h1>
                @if (Request::is('labels/*') || Request::is('artists/*'))
                    @if ($description)
                        <p class="lead">{{ $description }}</p>
                    @else
                        <p class="lead text-muted">No description!</p>
                    @endif
                @endif
            </div>
            <div class="col-5 text-right">
                @if ($image)
                    <img src="{{ asset('storage/' . $image) }}" alt="">
                @endif
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            @switch(Request::url())
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
                                {{ $record->released }}
                            @else
                                -
                            @endif
                        </dd>
                    </dl>
                    @break
                @default
                    
            @endswitch
        </div>
        @auth
            <div class="row justify-content-center mt-4">
                <div class="col-4">
                    <a href="{{ $url . $id }}/edit">
                        <button type="button" class="btn btn-info btn-lg btn-block">Edit</button>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-4">
                    <form action="{{ $url . $id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
@endsection