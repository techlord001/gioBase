@extends('layouts.bio')

@php
    $section = "Collectors";
    $name = $user->name;
    $image = $user->image;
    $url = "/collectors/";
    $id = $user->id;
    // $homepage = "";
@endphp