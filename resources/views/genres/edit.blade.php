@extends('layouts.form')

@php
    $title = "Edit Genre";
    $route = "/genres/" . $genre->id;
    $nameLabel = "Name";
    $altLabel = "genre";
    $descriptionLabel = "Description";
    $name = $genre->genre;
    $description = $genre->description;
@endphp