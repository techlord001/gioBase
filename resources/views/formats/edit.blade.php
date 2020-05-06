@extends('layouts.form')

@php
    $title = "Edit Format";
    $route = "/formats/" . $format->id;
    $nameLabel = "Format";
    $altLabel = "format";
    $name = $format->format;
@endphp