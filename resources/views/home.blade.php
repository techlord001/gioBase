@extends('layouts.table')

@php
    $title = "My Records";
@endphp

@section('dashboard')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <h3 class="text-center">Add</h3>
                    <ul class="list-group list-group-horizontal text-center">
                        <a href="labels/create" class="list-group-item list-group-item-action">Label</a>
                        <a href="artists/create" class="list-group-item list-group-item-action">Artist</a>
                        <a href="records/create" class="list-group-item list-group-item-action">Record</a>
                    </ul>
                    <br>
                    <h3 class="text-center">View</h3>
                    <ul class="list-group list-group-horizontal text-center">
                        <a href="labels" class="list-group-item list-group-item-action">Labels</a>
                        <a href="artists" class="list-group-item list-group-item-action">Artists</a>
                        <a href="records" class="list-group-item list-group-item-action">Records</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

