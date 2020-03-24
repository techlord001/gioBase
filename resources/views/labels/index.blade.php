<h1>Labels</h1>

<a href="/labels/create"><button>Add New Label</button></a>

@forelse ($labels as $label)
    <p><a href="/labels/{{ $label->id }}">{{ $label->name }}</a></p>
@empty
    No labels!
@endforelse