@extends('layouts.bio')

@php
    $section = "Records";
    $name = $record->name;
    $image = $record->image;
    $url = "/records/";
    $id = $record->id;
@endphp