@extends('layouts.layout')
@section('title') {{$translation->title_seo}} @stop
@section('url') {{route('slug',$translation->slug)}} @stop
@section('site_name') {{$translation->title_seo}} @stop
@section('description') {{$translation->description_seo}} @stop
@section('keywords') {{$translation->keyword_seo}} @stop
@section('image') {{$translation->post->image}} @stop

@section('content')

<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@foreach($translation->tags as $tag)

    <a href="{{route('tag.show', $tag->slug)}}" class="badge badge-primary">{{$tag->name}}</a>

@endforeach

@include('include.comment')


<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
@stop
