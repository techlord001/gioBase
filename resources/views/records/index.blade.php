<h1>Records</h1>

<a href="/records/create"><button>Add New Record</button></a>

@forelse ($records as $record)
    <p><a href="/records/{{ $record->id }}">{{ $record->name }}</a></p>
@empty
    No records!
@endforelse