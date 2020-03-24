<h1>Edit Label</h1>

<form action="/labels/{{ $label->id }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{ $label->name }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description">Brief Description:</label>
        <input type="text" name="description" id="description" autocomplete="off" value="{{ $label->description }}">
    </div>
    <div>
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image">
        @error('image')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit">Edit Label</button>
</form>