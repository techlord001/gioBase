@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">List of @yield('title')</h2>
        <a href=@yield('createLink')><button class="btn btn-primary btn-block mb-3">Add New @yield('btnTitle')</button></a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
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
                                <td>{{ $label->name }}</td>
                                <td class="text-right">
                                    <a href="/labels/{{ $label->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm">Show</button>
                                    </a>
                                    @auth
                                        <a href="/labels/{{ $label->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
                                    @endauth
                                </td>
                                @auth
                                    <td class="text-right">
                                        <form action="/labels/{{ $label->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td>No labels!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    @case(Request::is('artists'))
                        @forelse ($artists as $artist)
                            <tr>
                                <td>{{ $artist->name }}</td>
                                <td class="text-right">
                                    <a href="/artists/{{ $artist->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm">Show</button>
                                    </a>
                                    @auth
                                        <a href="/artists/{{ $artist->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
                                    @endauth
                                </td>
                                @auth
                                    <td class="text-right">
                                        <form action="/artists/{{ $artist->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td>No artists!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    @case(Request::is('records'))
                        @forelse ($records as $record)
                            <tr>
                                <td>{{ $record->name }}</td>
                                <td class="text-right">
                                    <a href="/records/{{ $record->id }}">
                                        <button type="button" class="btn btn-secondary btn-sm">Show</button>
                                    </a>
                                    @auth
                                        <a href="/records/{{ $record->id }}/edit">
                                            <button type="button" class="btn btn-info btn-sm">Edit</button>
                                        </a>
                                    @endauth
                                </td>
                                @auth
                                    <td class="text-right">
                                        <form action="/records/{{ $record->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td>No records!</td>
                            </tr>
                        @endforelse
                        
                        @break
                    @default
                        
                @endswitch
            </tbody>
        </table>
    </div>
@endsection