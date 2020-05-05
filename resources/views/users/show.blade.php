@extends('layouts.bio')

@php
    $section = "Users";
    $name = $user->name;
    $image = $user->image;
    $url = "/collectors/";
    $id = $user->id;
    // $homepage = "";
@endphp