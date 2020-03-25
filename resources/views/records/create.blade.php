<h1>Create Record</h1>

<form action="/records" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" autocomplete="off" value="{{ old('title') }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="artist_id">Artist:</label>
        <select name="artist_id" id="artist_id">
            @foreach ($artists as $artist)
            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="format_id">Format:</label>
        <select name="format_id" id="format_id">
            @foreach ($formats as $format)
            <option value="{{ $format->id }}">{{ $format->format }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="colour_id">Colours:</label>
        @foreach ($colours as $colour)
            <input type="checkbox" name="colour_id[]" id="colour_id" value="{{ $colour->id }}">{{ $colour->colour }}
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
    <button type="submit">Add Record</button>
</form>