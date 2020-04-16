@extends('layouts.form')

@php
    $name = $record->name;
@endphp

@section('title')
    Edit Record
@endsection

@section('route')
"/records/{{ $record->id }}"
@endsection

@section('nameLabel')
Title:
@endsection

@section('imageLabel')
Cover:
@endsection