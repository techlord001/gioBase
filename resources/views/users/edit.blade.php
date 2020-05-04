@extends('layouts.form')

@php
    $name = $user->name;
    $title = "Update My Profile";
    $route = "/users/" . $user->id;
    $nameLabel = "Username";
    $imageLabel = "Avatar";
    // $homepage = "";
@endphp