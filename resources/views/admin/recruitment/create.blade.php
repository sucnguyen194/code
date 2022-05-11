@extends('admin.layouts.layout')
@section('title')
    {{__('_add_new')}} {{\Illuminate\Support\Str::lower(__('lang.recruitment'))}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.recruitments.index')}}">{{__('lang.recruitment')}}</a></li>
                            <li class="breadcrumb-item active">{{__('_add_new')}} <span class="text-lowercase">{{__('lang.recruitment')}}</span></li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('_add_new')}} <span class="text-lowercase">{{__('lang.recruitment')}}</span></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="container-fluid">
        <form method="post" action="{{route('admin.posts.store')}}" class="ajax-form" enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-lg-9">
                    @include('admin.render.create.nav')
                        <div class="tab-content pt-0">
                            @foreach(languages() as $key => $language)
                                <div class="tab-pane language-{{$language->value}} {{$language->value == session('lang') ? 'active' : null}}" >
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
                        @include('admin.render.create.status')
                    </div>

                    <div class="card-box">
                        <label>{{__('lang.deadline')}} </label>
                        <input type="date" class="form-control" value="" id="deadline" name="data[deadline]">
                    </div>

                    @include('admin.render.create.category', ['type' => \App\Enums\CategoryType::recruitment])

                    <div class="card-box position-relative box-action-image">
                        @include('admin.render.create.image')
                    </div>

                    @include('admin.render.create.tag',['type' => \App\Enums\TagType::post])

                </div>

                <div class="col-lg-12">
                    <input type="hidden" name="data[type]" value="{{\App\Enums\PostType::recruitment}}">
                    @include('admin.render.button',['route' => route('admin.recruitments.index')])
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
