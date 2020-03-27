<h1>Edit Record</h1>

@extends('layouts.form')

@php
    $name = $record->name;
@endphp

@section('route')
"/records/{{ $record->id }}"
@endsection

@section('nameLabel')
Title:
@endsection

@section('imageLabel')
Cover:
@endsection

@section('submitLabel')
Edit Record
@endsection