@extends('layouts.bio')

@php
    $section = "Labels";
    $name = $label->name;
    $description = $label->description;
    $image = $label->image;
    $url = "/labels/";
    $id = $label->id;
    $homepage = $label->homepage;
@endphp