<h1>Edit Artist</h1>

@extends('layouts.form')

@php
    $name = $artist->name;
    $description = $artist->description;
@endphp

@section('route')
"/artists/{{ $artist->id }}"
@endsection

@section('nameLabel')
Name:
@endsection

@section('descriptionLabel')
Bio:
@endsection

@section('imageLabel')
Portrait:
@endsection

@section('submitLabel')
Edit Artist
@endsection