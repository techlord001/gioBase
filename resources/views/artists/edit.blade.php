@extends('layouts.form')

@php
    $name = $artist->name;
    $description = $artist->description;
    $title = "Edit Artist";
    $route = "/artists/" . $artist->id;
    $nameLabel = "Name";
    $descriptionLabel = "Bio";
    $imageLabel = "Portait";
    $homepage = $artist->homepage;
@endphp