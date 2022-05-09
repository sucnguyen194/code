@extends('admin.layouts.layout')
@section('title')
    {{__('lang.recruitment')}} #{{$recruitment->id}}
@stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('lang.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.recruitments.index')}}">{{__('lang.recruitment')}}</a></li>
                            <li class="breadcrumb-item">#{{$recruitment->id}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.recruitment')}} #{{$recruitment->id}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- end page title -->
        <form method="post" action="{{route('admin.posts.update',$recruitment)}}" class="ajax-form" enctype="multipart/form-data">
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
                                    @include('admin.render.edit.content')
                                </div>

                                <div class="card-box">
                                    @include('admin.render.edit.seo')
                                </div>

                            </div>
                        @endforeach

                                @foreach(languages()->whereNotIn('value', $translations->pluck('locale')->toArray()) as $key => $language)
                                    <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" id="language-{{$language->value}}">
                                        <div class="card-box">
                                            @include('admin.render.create.title')
                                            @include('admin.render.create.content')
                                        </div>

                                        <div class="card-box">
                                            @include('admin.render.create.seo')
                                        </div>

                                    </div>
                                @endforeach

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card-box">
                        @include('admin.render.edit.status',['item' => $recruitment])
                    </div>

                    <div class="card-box">
                        <label>{{__('lang.deadline')}} </label>
                        <input type="date" class="form-control" name="data[deadline]" value="{{$recruitment->deadline}}">
                    </div>

                    @include('admin.render.edit.category',['item' => $recruitment ,'type' => \App\Enums\CategoryType::recruitment])

                    <div class="card-box position-relative box-action-image">
                        @include('admin.render.edit.image',['item' => $recruitment])
                    </div>

                    @include('admin.render.edit.tag',['item' => $recruitment, 'type' => \App\Enums\TagType::post])

                </div>

                <div class="col-lg-12">
                    @include('admin.render.button',['route' => route('admin.recruitments.index') ])
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
