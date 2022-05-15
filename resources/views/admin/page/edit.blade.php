@extends('admin.layouts.layout')
@section('title')
    {{__('_page')}} #{{$page->id}}
@stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('_dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.pages.index')}}">{{__('_page')}}</a></li>
                            <li class="breadcrumb-item">#{{$page->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_page')}} #{{$page->id}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- end page title -->
        <form method="post" action="{{route('admin.posts.update',$page)}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                @method('PATCH')
                <div class="col-lg-9">
                    @include('admin.render.edit.nav')
                    <div class="tab-content pt-0">
                        @foreach($translations as $key => $translation)
                            <div class="tab-pane language-{{$translation->locale}} {{$translation->locale == session('lang') ? 'active' : null}}" id="language-{{$translation->locale}}">
                                <div class="card-box">
                                    @include('admin.render.edit.title')
                                    @include('admin.render.edit.description')
                                    @include('admin.render.edit.content')
                                </div>

                                <div class="card-box">
                                    @include('admin.render.edit.seo')
                                </div>

                            </div>
                        @endforeach

                        @if(setting('site.languages') || !$page->translation)

                            @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" id="language-{{$language->value}}">
                                    <div class="card-box">
                                        @include('admin.render.create.title')
                                        @include('admin.render.create.description')
                                        @include('admin.render.create.content')
                                    </div>

                                    <div class="card-box">
                                        @include('admin.render.create.seo')
                                    </div>

                                </div>
                            @endforeach

                        @endif
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card-box">
                        @include('admin.render.edit.status',['item' => $page])
                    </div>
                    <div class="card-box position-relative box-action-image">
                        @include('admin.render.edit.image', ['item' => $page])
                    </div>

                    @include('admin.render.edit.tag',['item' => $page, 'type' => \App\Enums\TagType::post])

                </div>

                <div class="col-lg-12">
                    @include('admin.render.button', ['route' => route('admin.posts.pages.index')])
                </div>
            </div>
            <!-- end row -->
        </form>
    </div>
    <script>
        $('[data-toggle="tab"]').on('click',function(e){
            e.preventDefault();
            let pane = $(this).attr('href');

            $('.tab-pane').removeClass('active').hide();
            $(pane).addClass('active').show();
        });
    </script>
@stop
