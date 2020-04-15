@extends('layouts.app')

@section('content')
<div class="container">
    <h2>@yield('title')</h2>
    <form action=@yield('route') method="post" enctype="multipart/form-data">
        @if (Request::segment(3) == 'edit')
            @method('patch')
        @endif
            @csrf
            <div class="form-row">
                <div class="col form-group">
                    <label for="name">@yield('nameLabel')</label>
                    <input type="text" name="name" id="name" autocomplete="off" value="{{ $name ?? old('name') }}" class="form-control">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if (Request::is('artists/*'))
                    <div class="col form-group">
                        <label for="label_id">Label</label>
                        <select name="label_id" id="label_id" class="form-control">
                            @foreach ($labels as $label)
                            <option value="{{ $label->id }}"
                                @if (isset($artist->label_id))
                                    @if ($label->id === $artist->label_id)
                                        selected
                                    @endif
                                @endif
                                >{{ $label->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        @if (Request::is('labels/*') || Request::is('artists/*'))
            <div class="form-group">
                <label for="description">Brief @yield('descriptionLabel')</label>
                <textarea type="text" name="description" id="description" autocomplete="off" value="{{ $description ?? old('description') }}" class="form-control"></textarea>
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
                <input type="date" name="released" id="released" class="form-control">
                @error('released')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        @endif
        <label for="image">Upload @yield('imageLabel')</label>
        <div class="custom-file">
            <span class="custom-file-label">Choose an image</span>
            <input type="file" name="image" id="image" class="custom-file-input">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Save Edit</button>
    </form>
</div>
@endsection