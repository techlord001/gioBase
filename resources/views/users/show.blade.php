@extends('layouts.bio')

@php
    $section = "Users";
    $name = $user->name;
    $image = $user->image;
    $url = "/users/";
    $id = $user->id;
    // $homepage = "";
@endphp