<div>
    <a href="/labels"><button>Back</button></a>
</div>
<h1>{{ $label->name }}</h1>

@if ($label->description)
<p>{{ $label->description }}</p>
@endif

@forelse ($label->artist as $artist)
    <p>{{ $artist->name }}</p>
@empty
    <p>No artists signed!</p>
@endforelse

@if ($label->image)
    <img src="{{ asset('storage/' . $label->image) }}" alt="">
@endif

<div>
    <a href="/labels/{{ $label->id }}/edit"><button>Edit</button></a>
</div>

<div>
    <form action="/labels/{{ $label->id }}" method="post">
        @method('delete')
        @csrf
        <button>Delete</button>
    </form>
</div>