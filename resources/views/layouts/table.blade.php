@extends('layouts.app')

@php
    $titleExt = " | ";

    switch (Request::url()) {
        case (Request::is('labels')):
            $titleExt .= "Labels";
            break;
        case (Request::is('artists')):
            $titleExt .= "Artists";
            break;
        case (Request::is('records')):
            $titleExt .= "Records";
            break;
        case (Request::is('home')):
            $titleExt .= "Home";
            break;
        default:
            $titleExt .= "Vaporwave Database";
            break;
    }
@endphp

@section('content')
    <div class="container-fluid px-5 table-responsive">
        <h3 class="text-center">List of {{ $title }}</h3>
        @if (!Request::is('home'))
            @auth
                @if (auth()->user()->hasRole('Contributor') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Master'))
                    <a href="{{ $link }}"><button class="btn btn-primary mb-3 px-2">Add New {{ $btnTitle }}</button></a>                    
                @endif
            @endauth
        @endif
        <table class="table table-hover gbTable">
            {{-- ******************** TABLE HEADERS ******************** --}}
            <thead>
                <tr>
                    <th class="text-center">
                        @switch(Request::url())
                            @case(Request::is('labels'))
                                Logo
                                @break
                            @case(Request::is('artists'))
                                Portrait
                                @break
                            @case(Request::is('records') || Request::is('home'))
                                Cover
                                @break
                            @default
                                -
                        @endswitch
                    </th>
                    <th>Name</th>
                    @if (Request::is('records') || Request::is('home'))
                        <th>Artist</th>
                    @endif
                    @if (Request::is('artists') || Request::is('records') || Request::is('home'))
                    <th>Label</th>
                    @endif
                    @if (Request::is('records') || Request::is('home'))
                        <th class="text-center">Format</th>
                        <th class="text-center">Colour</th>
                        <th class="text-center">Released</th>
                    @endif
                    <th class="text-right">Options</th>
                    @if (!Request::is('home'))
                        @can('delete', App\Label::class)
                            <th class="text-right">Delete</th>
                        @elsecan('delete', App\Artist::class)
                            <th class="text-right">Delete</th>
                        @elsecan('delete', App\Record::class)
                            <th class="text-right">Delete</th>
                        @endcan                        
                    @else
                        <th class="text-right">Remove</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @switch(Request::url())
                    {{-- ******************** LABELS LAYOUT ******************** --}}
                    @case(Request::is('labels'))
                        @forelse ($labels as $label)
                            <tr>
                                <td class="align-middle text-center">
                                    @if ($label->image)
                                        <img src="{{ asset('storage/' . $label->image) }}" alt="" class="img-thumbnail rounded table-item-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="align-middle">{{ $label->name }}</td>
                                <td class="align-middle text-right">
                                    <a href="/labels/{{ $label->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm" title="View">
                                            <span class="icon">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </button>
                                    </a>
                                    @can('update', App\Label::class)
                                        <a href="/labels/{{ $label->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm" title="Edit">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>                                                    
                                                </span>
                                            </button>
                                        </a>
                                    @endcan
                                </td>
                                @can('delete', App\Label::class)
                                    <td class="align-middle text-right">
                                        <form action="/labels/{{ $label->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                                <span class="icon">
                                                    <i class="fas fa-trash-alt"></i>                                                    
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td class="text-center" colspan="100%">No labels!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    {{-- ******************** ARTIST LAYOUT ******************** --}}
                    @case(Request::is('artists'))
                        @forelse ($artists as $artist)
                            <tr>
                                <td class="align-middle text-center">
                                    @if ($artist->image)
                                        <img src="{{ asset('storage/' . $artist->image) }}" alt="" class="img-thumbnail rounded table-item-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="align-middle">{{ $artist->name }}</td>
                                <td class="align-middle">
                                    @if ($artist->label_id)
                                        {{ $artist->label->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="align-middle text-right">
                                    <a href="/artists/{{ $artist->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm" title="View">
                                            <span class="icon">
                                                <i class="fas fa-eye"></i>                                                    
                                            </span>
                                        </button>
                                    </a>
                                    @can('update', App\Artist::class)
                                        <a href="/artists/{{ $artist->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm" title="Edit">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>  
                                                </span>
                                            </button>
                                        </a>
                                    @endcan
                                </td>
                                @can('delete', App\Artist::class)
                                    <td class="align-middle text-right">
                                        <form action="/artists/{{ $artist->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                                <span class="icon">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td class="text-center" colspan="100%">No artists!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    {{-- ******************** RECORDS/HOME(USER COLLECTION) LAYOUT ******************** --}}
                    @case(Request::is('records') || Request::is('home'))
                        @forelse ($records as $record)
                            <tr>
                                <td class="align-middle text-center">
                                    @if ($record->image)
                                        <img src="{{ asset('storage/' . $record->image) }}" alt="" class="img-thumbnail rounded table-item-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $record->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $record->artist->name }}
                                </td>
                                <td class="align-middle">
                                    @if ($record->artist->label)
                                        {{ $record->artist->label->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($record->format_id)
                                        {{ $record->format->format }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($record->colour_id)
                                        {{ $record->colour->colour }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if ($record->released)
                                        {{ date('jS M Y', strtotime($record->released)) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-right align-middle">
                                    <div class="d-flex flex-row flex-nowrap justify-content-around">
                                        {{-- ******************** VIEW BUTTON ******************** --}}
                                        <a href="/records/{{ $record->id }}">
                                            <button type="button" class="btn btn-secondary btn-sm mx-1" title="View">
                                                <span class="icon">
                                                    <i class="fas fa-eye"></i>                                                    
                                                </span>
                                            </button>
                                        </a>
                                        @auth
                                            @can('update', App\Record::class)
                                                {{-- ******************** EDIT BUTTON ******************** --}}
                                                <a href="/records/{{ $record->id }}/edit">
                                                    <button type="button" class="btn btn-info btn-sm mx-1" title="Edit">
                                                        <span class="icon">
                                                            <i class="fas fa-edit"></i>                                                    
                                                        </span>
                                                    </button>
                                                </a>                                                
                                            @endcan
                                            @if (Request::is('records'))
                                                @php
                                                    $match = "";
    
                                                    foreach ($userRecords as $userRecord) {
                                                        if ($userRecord->id === $record->id) {
                                                            $match = true;
                                                            break;
                                                        } else {
                                                            $match = false;
                                                        }
                                                    }
                                                @endphp
                                                @if ($match)
                                                    {{-- ******************** REMOVE FROM COLLECTION BUTTON ******************** --}}
                                                    <form action="/home/{{ $record->id }}" method="post" class="mx-1">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm" title="In Collection">
                                                            <span class="icon">
                                                                <i class="fas fa-check-square"></i>                                                    
                                                            </span>
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- ******************** ADD TO COLLECTION BUTTON ******************** --}}
                                                    <form action="/home/{{ $record->id }}" method="post" class="mx-1">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm btn-dark" title="Add To Collection">
                                                            <span class="icon">
                                                                <i class="fas fa-plus-square"></i>                                                    
                                                            </span>
                                                        </button>
                                                    </form>                                                
                                                @endif
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                                @if (Request::is('home'))
                                    <td class="text-right align-middle">
                                        {{-- ******************** REMOVE FROM COLLECTION BUTTON ******************** --}}
                                        <form action="/home/{{ $record->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Remove From Collection">
                                                <span class="icon">
                                                    <i class="fas fa-minus-square"></i>                                                    
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                    @else
                                        @can('delete', App\Record::class)
                                            <td class="text-right align-middle">
                                                {{-- ******************** DELETE ENTRY BUTTON ******************** --}}
                                                <form action="/records/{{ $record->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Entry">
                                                        <span class="icon">
                                                            <i class="fas fa-trash-alt"></i>                                                    
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                @endif
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td class="text-center" class="text-center" colspan="100%">No records!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    @default
                        
                @endswitch
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center pt-4">
                @if (isset($labels))
                    {{ $labels->links() }}                    
                @elseif (isset($artists))
                    {{ $artists->links() }}               
                @elseif (isset($records))
                    {{ $records->links() }}              
                @endif
            </ul>
        </nav>
    </div>
@endsection