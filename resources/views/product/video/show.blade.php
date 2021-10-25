@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->product->image}} @stop
@section('content')
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@include('include.comment')
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
