<h1>Edit Record</h1>

<form action="/records/{{ $record->id }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" autocomplete="off" value="{{ $record->title }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="artist_id">Artist:</label>
        <select name="artist_id" id="artist_id">
            @foreach ($artists as $artist)
            <option value="{{ $artist->id }}"
                @if ($artist->id === $record->artist_id)
                    selected
                @endif
                >{{ $artist->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="format_id">Format:</label>
        <select name="format_id" id="format_id">
            @foreach ($formats as $format)
            <option value="{{ $format->id }}"
                @if ($format->id === $record->format_id)
                    selected
                @endif
                >{{ $format->format }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="colour_id">Colours:</label>
        @foreach ($colours as $colour)
            <input type="checkbox" name="colour_id[]" id="colour_id" value="{{ $colour->id }}"
            @foreach ($record->colours as $colour_id)
                @if ($colour->id === $colour_id->id)
                    checked
                @endif
            @endforeach
            >{{ $colour->colour }}
        @endforeach
        @error('colours')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="cover">Upload Cover:</label>
        <input type="file" name="cover" id="cover">
        @error('cover')
            <p>{{ $message }}</p>
        @enderror
    </div>
    </div>
    <button type="submit">Edit Record</button>
</form>