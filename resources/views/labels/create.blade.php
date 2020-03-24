<h1>Create Label</h1>

<form action="/labels" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{ old('name') }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description">Brief Description:</label>
        <input type="text" name="description" id="description" autocomplete="off" value="{{ old('description') }}">
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