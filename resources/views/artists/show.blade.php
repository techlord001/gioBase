<div>
    <a href="/artists"><button>Back</button></a>
</div>
<h1>{{ $artist->name }}</h1>

@if ($artist->history)
<p>{{ $artist->history }}</p>
@endif

@if ($artist->label_id)
<p>{{ $artist->label->name }}</p>
@endif

@forelse ($artist->records as $record)
    <p>{{ $record->name }}</p>
@empty
    <p>No records yet!</p>
@endforelse

@if ($artist->image)
    <img src="{{ asset('storage/' . $artist->image) }}" alt="">
@endif

<div>
    <a href="/artists/{{ $artist->id }}/edit"><button>Edit</button></a>
</div>

<div>
    <form action="/artists/{{ $artist->id }}" method="post">
        @method('delete')
        @csrf
        <button>Delete</button>
    </form>
</div>