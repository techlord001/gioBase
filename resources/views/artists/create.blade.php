<h1>Create Artist</h1>

<form action="/artists" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{ old('name') }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="history">Brief Description:</label>
        <input type="text" name="history" id="history" autocomplete="off" value="{{ old('history') }}">
    </div>
    <div>
        <label for="label_id">Label</label>
        <select name="label_id" id="label_id">
            <option value=""></option>
            @foreach ($labels as $label)
            <option value="{{ $label->id }}">{{ $label->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>
    </div>
    <button type="submit">Add Label</button>
</form>