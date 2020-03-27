<h1>Edit Label</h1>

@extends('layouts.form')

@php
    $name = $label->name;
    $description = $label->description;
@endphp

@section('route')
"/labels/{{ $label->id }}"
@endsection

@section('nameLabel')
Name:
@endsection

@section('descriptionLabel')
Description:
@endsection

@section('imageLabel')
Logo:
@endsection

@section('submitLabel')
Label
@endsection