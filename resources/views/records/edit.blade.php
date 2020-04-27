@extends('layouts.form')

@php
    $name = $record->name;
    $title = "Edit Record";
    $route = "/records/" . $record->id;
    $nameLabel = "Title";
    $imageLabel = "Cover";
    $homepage = $record->homepage;
@endphp