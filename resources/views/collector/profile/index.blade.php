@extends('layouts.bio')

@php
    $section = "My Collection";
    $name = $user->name;
    $image = $user->image;
    $url = "/home/collection/";
    $id = $user->id;
    // $homepage = "";
@endphp