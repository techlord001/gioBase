<h1>Artists</h1>

<a href="/artists/create"><button>Add New Artist</button></a>

@forelse ($artists as $artist)
    <p><a href="/artists/{{ $artist->id }}">{{ $artist->name }}</a></p>
@empty
    No artists!
@endforelse