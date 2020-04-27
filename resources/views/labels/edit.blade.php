@extends('layouts.form')

@php
    $name = $label->name;
    $description = $label->description;
    $title = "Edit Label";
    $route = "/labels/" . $label->id ;
    $nameLabel = "Name";
    $descriptionLabel = "Description";
    $imageLabel = "Logo";
    $homepage = $label->homepage;
@endphp