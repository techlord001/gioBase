@extends('layouts.form')

@php
    $name = $artist->name;
    $description = $artist->description;
@endphp

@section('title')
    Edit Artist
@endsection

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