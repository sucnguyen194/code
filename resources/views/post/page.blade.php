@extends('layouts.layout')
@section('title') {{$post->translation->title_seo}} @stop
@section('url') {{$post->slug}} @stop
@section('site_name') {{$post->translation->title_seo}} @stop
@section('description') {{$post->translation->description_seo}} @stop
@section('keywords') {{$post->translation->keyword_seo}} @stop
@section('image') {{$post->image}} @stop
@section('content')

    @if($post->translation->slug == 'gioi-thieu')
        @include('ladipage.about')
    @elseif($post->translation->slug == 'lien-ket-hop-tac')
        @include('ladipage.partner')

    @elseif($post->translation->slug == 've-chung-toi')
        @include('ladipage.aboutUs')

    @elseif($post->translation->slug == 'cau-hoi-thuong-gap')
        @include('ladipage.quession')

    @elseif($post->translation->slug == 'cham-soc-suc-khoe')
        @include('ladipage.choise_v1')

    @elseif($post->translation->slug == 'dau-tu-hieu-qua')
        @include('ladipage.choise_v2')

    @elseif($post->translation->slug == 'tich-luy-tuong-lai')
        @include('ladipage.choise_v3')

    @elseif($post->translation->slug == 'an-nhan-tuoi-gia')
        @include('ladipage.choise_v4')

    @elseif($post->translation->slug == 'dac-quyen')
        @include('ladipage.power')

    @endif
@stop
