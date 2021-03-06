@extends('layouts.app')

@php

    if (Request::is('*/create')) {
        $titleExt = " | Add New ";
        
        switch (Request::url()) {
            case (Request::is('labels/create')):
                $titleExt .= "Label";
                break;
            case (Request::is('artists/create')):
                $titleExt .= "Artist";
                break;
            case (Request::is('records/create')):
                $titleExt .= "Record";
                break;
            case (Request::is('genres/create')):
                $titleExt .= "Genre";
                break;
            case (Request::is('colours/create')):
                $titleExt .= "Colour";
                break;
            case (Request::is('formats/create')):
                $titleExt .= "Format";
                break;
            default:
                $titleExt .= "Entry";
                break;
        }
    } elseif (Request::is('*/*/edit')) {
        $titleExt = " | Edit ";

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
            case (Request::is('genres/*')):
                $titleExt .= $genre->genre;
                break;
            case (Request::is('colours/*')):
                $titleExt .= $colour->colour;
                break;
            case (Request::is('formats/*')):
                $titleExt .= $format->format;
                break;
            case (Request::is('collectors/*')):
                $titleExt .= "Profile";
                break;
            default:
                $titleExt .= "Entry";
                break;
        }
    } else {
        $titleExt = " | Vaporwave Database";
    }

@endphp

@section('content')
<div class="container gbCard p-5 rounded">
    <h2>{{ $title }}</h2>
    <form action="{{ $route }}" method="post" enctype="multipart/form-data">
        @if (Request::segment(3) == 'edit')
            @method('patch')
        @endif
            @csrf
            <div class="form-row">
                <div class="col form-group">
                    <label for="{{ $altLabel ?? 'name' }}">{{ $nameLabel }}</label>
                    <input type="text" name="{{ $altLabel ?? 'name' }}" id="name" autocomplete="off" value="{{ $name ?? old('name') }}" class="form-control"
                    @if (Request::is('collectors/*') && Auth::user()->id !== $user->id)
                        disabled
                    @endif>
                    @if (isset($altLabel))
                        @error($altLabel)
                            <small class="text-danger">{{ $message }}</small>
                        @enderror                        
                    @else
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror                        
                    @endif
                </div>
            </div>
            @if (Request::is('artists/*'))
                <div class="form-row">
                    <div class="col form-group">
                        <h6>Label</h6>
                        <div class="d-flex flex-wrap flex-row justify-content-between align-content-between">
                            @foreach ($labels as $label)
                                <div class="custom-control custom-switch mx-2 my-1">
                                    <input type="checkbox" name="labels[{{ $label->id }}]" id="labels[{{ $label->id }}]" class="custom-control-input" value="{{ $label->name }}"
                                    @if (isset($artist->labels))
                                        @foreach ($artist->labels as $artistLabel)
                                            @if ($artistLabel->id === $label->id)
                                                checked="checked"
                                            @endif
                                        @endforeach                            
                                    @endif> 
                                    <label for="labels[{{ $label->id }}]" class="custom-control-label">{{ $label->name }}</label>
                                </div>            
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @if (Request::is('labels/*', 'artists/*', 'genres/*'))
            <div class="form-group">
                <label for="description">Brief {{ $descriptionLabel }}</label>
                <textarea type="text" name="description" id="description" autocomplete="off" class="form-control">{{ $description ?? old('description') }}</textarea>
            </div>
        @endif
        @if (Request::is('records/*'))
            <div class="form-group">
                <label for="artist_id">Artist</label>
                <select name="artist_id" id="artist_id" class="form-control">
                    @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}"
                        @if (isset($record->artist_id))
                            @if ($artist->id === $record->artist_id)
                                selected
                            @endif
                        @endif
                        >{{ $artist->name }}</option>
                    @endforeach
                </select>
                @error('artist_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <h6>Label</h6>
                    <select name="label_id" id="label_id" class="form-control">
                        @foreach ($labels as $label)
                        <option value="{{ $label->id }}"
                            @if (isset($record->label_id))
                                @if ($label->id === $record->label_id)
                                    selected
                                @endif
                            @endif
                            >{{ $label->name }}</option>           
                        @endforeach
                    </select>
                </div>
                <div class="col form-group">
                    <h6>Catalog #</h6>
                    <input type="text" name="catalog_num" id="catalog_num" class="form-control" value="{{ $record->catalog_num ?? old('catalog_num') }}">
                    @error('catalog_num')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <h6>Genre</h6>
                    <div class="d-flex flex-wrap flex-row justify-content-between align-content-between">                
                        @foreach ($genres as $genre)
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="genres[{{ $genre->id }}]" id="genres[{{ $genre->id }}]" class="custom-control-input" value="{{ $genre->genre }}"
                                @if (isset($record->genres))
                                    @foreach ($record->genres as $recordGenre)
                                        @if ($recordGenre->id === $genre->id)
                                            checked="checked"
                                        @endif
                                    @endforeach                            
                                @endif> 
                                <label for="genres[{{ $genre->id }}]" class="custom-control-label">{{ $genre->genre }}</label>
                            </div>            
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="format_id">Format</label>
                    <select name="format_id" id="format_id" class="form-control">
                        @foreach ($formats as $format)
                        <option value="{{ $format->id }}"
                            @if (isset($record->format_id))
                                @if ($format->id === $record->format_id)
                                    selected
                                @endif
                            @endif
                            >{{ $format->format }}</option>
                        @endforeach
                    </select>
                    @error('format_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col form-group">
                    <label for="colour_id">Colour</label>
                    <select name="colour_id" id="colour_id" class="form-control">
                        @foreach ($colours as $colour)
                            <option value="{{ $colour->id }}"
                                @if (isset($record->colour_id))
                                    @if ($colour->id === $record->colour_id)
                                        selected
                                    @endif
                                @endif
                                >{{ $colour->colour }}</option>
                        @endforeach
                    </select>
                    @error('colours')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col form-group">
                    <label for="released">Released</label>
                    {{-- <input type="date" name="released" id="released" class="form-control" value="{{ $record->released ?? old('released') }}" max="{{ Carbon\Carbon::now()->toDateString() }}"> --}}
                    <select name="released" id="released" class="form-control">
                        <option value="">-</option>
                        @php
                            $currentYear = Carbon\Carbon::now()->year;
                            $baseYear = 2010;
                        @endphp
                        @while ($currentYear !== $baseYear)
                            <option value="{{ $currentYear }}"
                            @if (isset($record->released))
                                @if ($record->released === $currentYear)
                                    selected
                                @endif                           
                            @endif>{{ $currentYear }}</option>
                            @php
                                --$currentYear;
                            @endphp
                        @endwhile
                    </select>
                    @error('released')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endif
        <div class="form-row">
            @if (!Request::is('formats/*', 'colours/*', 'genres/*', 'formats/*/edit', 'colours/*/edit', 'genres/*/edit'))
                <div class="col form-group">
                    <label for="image">Upload {{ $imageLabel }}</label>
                    <input type="file" class="form-control-file" name="image" id="image"
                    @if (Request::is('collectors/*') && Auth::user()->id !== $user->id)
                        disabled
                    @endif>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if (!Request::is('collectors/*/edit'))
                    <div class="col form-group">
                        <label for="homepage">Homepage</label>
                        <input type="url" name="homepage" id="homepage" class="form-control" value="{{ $homepage ?? old('homepage') }}">
                        @error('homepage')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    @if (Auth::user()->hasRole('Master') && Auth::user()->id !== $user->id)
                        <div class="col form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if ($role->id === $user->role->id)
                                            selected
                                        @endif
                                        >{{ $role->role }}</option>
                                @endforeach
                            </select>
                            @error('homepage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> 
                    @endif                            
                @endif
            @endif
        </div>
        @if (Request::is('*/*/edit'))
            <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Save Edit</button>            
        @else
            <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Add New Entry</button>            
        @endif
        <a href="{{ url()->previous() }}" class="text-decoration-none">
            <button type="button" class="btn btn-danger btn-lg btn-block mt-4">Cancel</button>            
        </a>
    </form>
</div>
@endsection