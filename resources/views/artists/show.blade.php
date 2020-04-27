@extends('layouts.bio')

@php
    $section = "Artists";
    $name = $artist->name;
    $description = $artist->description;
    $image = $artist->image;
    $url = "/artists/";
    $id = $artist->id;
    $homepage = $artist->homepage;
@endphp