@extends('layouts.form')

@php
    $name = $label->name;
    $description = $label->description;
@endphp

@section('title')
    Edit Label
@endsection

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