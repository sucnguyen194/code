@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->category->image}} @stop
@section('content')
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->

@foreach(\App\Models\Language::all() as $lang)

    <a href="{{route('languages.change', $lang->value)}}">{{$lang->name}}</a>

    @endforeach

<h1>{{$translation->name}}</h1>
<hr>
<p>
    {!! $translation->description !!}
</p>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
