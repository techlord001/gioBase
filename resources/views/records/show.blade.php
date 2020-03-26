<div>
    <a href="/records"><button>Back</button></a>
</div>
<h1>{{ $record->name }}</h1>

<h2>{{ $record->artist->name }}</h2>

@if ($record->format_id)
<p>{{ $record->format->format }}</p>
@endif

@if ($record->colour_id)
<p>{{ $record->colour->colour }}</p>
@endif

@if ($record->released)
<p>{{ $record->released }}</p>
@endif

@if ($record->image)
    <img src="{{ asset('storage/' . $record->image) }}" alt="">
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