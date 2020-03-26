<h1>Create Record</h1>

<form action="/records" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Title:</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{ old('name') }}">
        @error('name')
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
        @error('artist_id')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="format_id">Format:</label>
        <select name="format_id" id="format_id">
            @foreach ($formats as $format)
            <option value="{{ $format->id }}">{{ $format->format }}</option>
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
                <option value="{{ $colour->id }}">{{ $colour->colour }}</option>
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
    <div>
        <label for="image">Upload Cover:</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>
    </div>
    <button type="submit">Add Record</button>
</form>