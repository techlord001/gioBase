<div>
    <a href="/records"><button>Back</button></a>
</div>
<h1>{{ $record->title }}</h1>

<h2>{{ $record->artist->name }}</h2>

@if ($record->format_id)
<p>{{ $record->format->format }}</p>
@endif

@if ($record->colour_id)
    <ul>
        @foreach ($record->colours as $colour)
            <li>{{ $colour->colour }}</li>
        @endforeach
    </ul>
@endif

@if ($record->cover)
    <img src="{{ asset('storage/' . $record->cover) }}" alt="">
@endif

<div>
    <a href="/records/{{ $record->id }}/edit"><button>Edit</button></a>
</div>

<div>
    <form action="/records/{{ $record->id }}" method="post">
        @method('delete')
        @csrf
        <button>Delete</button>
    </form>
</div>