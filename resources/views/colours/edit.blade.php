@extends('layouts.form')

@php
    $title = "Edit Colour";
    $route = "/colours/" . $colour->id;
    $nameLabel = "Colour";
    $altLabel = "colour";
    $name = $colour->colour;
@endphp