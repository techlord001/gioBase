<h1>Edit Artist</h1>

<form action="/artists/{{ $artist->id }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" autocomplete="off" value="{{ $artist->name }}">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description">Brief History:</label>
        <input type="text" name="description" id="description" autocomplete="off" value="{{ $artist->description }}">
    </div>
    <div>
        <label for="label_id">Label</label>
        <select name="label_id" id="label_id">
            <option value=""></option>
            @foreach ($labels as $label)
            <option value="{{ $label->id }}" 
                @if ($label->id === $artist->label_id)
                    selected
                @endif
                >{{ $label->name }}</option>
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
    <button type="submit">Edit Label</button>
</form>