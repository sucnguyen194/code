@extends('layouts.layout')
@section('title') Tags: #{{$slug}} @stop
@section('content')

@foreach($translations as $translation)
     {{$translation->name}}



@endforeach

@stop
