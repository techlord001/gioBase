@extends('layouts.app')

@section('content')
    <div class="container gbCard p-5 d-flex justify-content-center text-center">
        <div class="col-8">
            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                <a href="{{ $link }}"><button class="btn btn-primary mb-3 px-2">Add New {{ $btnTitle }}</button></a>                    
            @endif
            <h3>{{ $title }}</h3>
            <ul class="list-group list-group-flush">
                @if (Request::is('formats'))
                    @forelse ($formats as $format)
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center gbList-item">
                            <a href="/formats/{{ $format->id }}/edit">
                                <button type="button" class="btn btn-info btn-sm mx-1 text-left" title="Edit">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>                                                    
                                    </span>
                                </button>
                            </a> 
                            {{ $format->format }}
                            <form action="/formats/{{ $format->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                    <span class="icon">
                                        <i class="fas fa-trash-alt"></i>                                                    
                                    </span>
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No formats!</li>
                    @endforelse                    
                @endif
                @if (Request::is('colours'))
                    @forelse ($colours as $colour)
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center gbList-item">
                            <a href="/colours/{{ $colour->id }}/edit">
                                <button type="button" class="btn btn-info btn-sm mx-1 text-left" title="Edit">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>                                                    
                                    </span>
                                </button>
                            </a>
                            {{ $colour->colour }}
                            <form action="/colours/{{ $colour->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                    <span class="icon">
                                        <i class="fas fa-trash-alt"></i>                                                    
                                    </span>
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No colours!</li>
                    @endforelse                    
                @endif
            </ul>
        </div>
    </div>
@endsection