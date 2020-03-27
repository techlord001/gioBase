<form action=@yield('route')method="post" enctype="multipart/form-data">
    @if (Request::segment(3) == 'edit')
        @method('patch')
    @endif
        @csrf
        <div>
            <label for="name">@yield('nameLabel')</label>
            <input type="text" name="name" id="name" autocomplete="off" value="{{ $name ?? old('name') }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
    @if (Request::is('labels/*') || Request::is('artists/*'))
        <div>
            <label for="description">Brief @yield('descriptionLabel')</label>
            <input type="text" name="description" id="description" autocomplete="off" value="{{ $description ?? old('description') }}">
        </div>
    @endif
    @if (Request::is('artists/*'))
        <div>
            <label for="label_id">Label</label>
            <select name="label_id" id="label_id">
                @foreach ($labels as $label)
                <option value="{{ $label->id }}">{{ $label->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
    @if (Request::is('records/*'))
        <div>
            <label for="artist_id">Artist:</label>
            <select name="artist_id" id="artist_id">
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
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="format_id">Format:</label>
            <select name="format_id" id="format_id">
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
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="colour_id">Colours:</label>
            <select name="colour_id" id="colour_id">
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
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="released">Released:</label>
            <input type="date" name="released" id="released">
            @error('released')
                <p>{{ $message }}</p>
            @enderror
        </div>
    @endif
    <div>
        <label for="image">Upload @yield('imageLabel')</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit">@yield('submitLabel')</button>
</form>