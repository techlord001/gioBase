@extends('layouts.app')

@section('content')
    @yield('dashboard')
    <div class="container-fluid px-5 table-responsive">
        <h2 class="text-center">List of {{ $title }}</h2>
        @if (Request::is('labels') || Request::is('artists') || Request::is('records'))
            @auth
                <a href="{{ $link }}"><button class="btn btn-primary btn-block mb-3">Add New {{ $btnTitle }}</button></a>
            @endauth
        @endif
        <table class="table table-hover">
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
                    @auth
                        <th class="text-right">Remove</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @switch(Request::url())
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
                                        <button type="button" class="btn btn-secondary btn-sm">Details</button>
                                    </a>
                                    @auth
                                        <a href="/labels/{{ $label->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
                                    @endauth
                                </td>
                                @auth
                                    <td class="align-middle text-right">
                                        <form action="/labels/{{ $label->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td>No labels!</td>
                            </tr>
                        @endforelse
                        
                        @break
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
                                        <button type="button" class="btn btn-secondary btn-sm">Details</button>
                                    </a>
                                    @auth
                                        <a href="/artists/{{ $artist->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
                                    @endauth
                                </td>
                                @auth
                                    <td class="align-middle text-right">
                                        <form action="/artists/{{ $artist->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td>No artists!</td>
                            </tr>
                        @endforelse
                        
                        @break
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
                                    <a href="/records/{{ $record->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm">Details</button>
                                    </a>
                                    @auth
                                        <a href="/records/{{ $record->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
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
                                                <button type="submit" class="btn btn-success btn-sm">Added</button>
                                            @else
                                                <form action="/home/{{ $record->id }}" method="post" class="float-right ml-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm btn-dark">+</button>
                                                </form>                                                
                                            @endif
                                        @endif
                                    @endauth
                                </td>
                                @auth
                                    <td class="text-right align-middle">
                                        @if (Request::is('home'))
                                        <form action="/home/{{ $record->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                        @else
                                        <form action="/records/{{ $record->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @endif
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td class="align-middle text-center" colspan="9">No records!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    @default
                        
                @endswitch
            </tbody>
        </table>
    </div>
@endsection