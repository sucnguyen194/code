@extends('layouts.layout')
@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="1420" class="elementor elementor-1420"
         data-elementor-settings="[]">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                @include('partials.slider', ['sliders' => $sliders])
                @include('partials.partner', ['partners' => $partners])
                @include('partials.param')
                @include('partials.choise')
                @include('partials.posts', ['categories' => $categoris])
                @include('partials.register')
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <script>
        $('body').addClass('post-template-default single single-post postid-8182 single-format-standard wp-custom-logo sidebar-active elementor-default elementor-kit-4327');
    </script>
    @stop
