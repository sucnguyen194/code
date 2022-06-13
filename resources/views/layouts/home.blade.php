@extends('layouts.layout')
@section('content')
    <form method="post" action="{{route('send.contact')}}">
        @csrf
        <input name="data[name]" value="1">
        <input name="data[email]" value="admin@gmail.com">
        <button type="submit">Send</button>
    </form>
@endsection

@section('styles')
    <script>
        $('body').addClass('post-template-default single single-post postid-8182 single-format-standard wp-custom-logo sidebar-active elementor-default elementor-kit-4327');
    </script>
    @stop
