@extends('admin.layouts.layout')
@section('title')
    {{__('lang.system_configuration')}}
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
                            <li class="breadcrumb-item active">{{__('lang.system_configuration')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('lang.system_configuration')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
<div class="container">
    <!-- Clickable Wizard -->
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.settings')}}" method="post" id="form-update" class="ajax-form" enctype="multipart/form-data">
                <div class="mt-3">
                    <button type="reset" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-refresh-ccw"></i></span> {{__('lang.reset')}}</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.save')}}</button>
                </div>
                @csrf
                <div id="wizard-clickable" >
                    <fieldset title="1" class="p-0">
                        <legend>{{__('lang.website_information')}}</legend>
                        <div class="row mt-1">
                            <div class="col-md-8">
                                @if(setting('site.languages'))
                                <ul class="nav nav-tabs tabs-bordered nav-justified pt-1 bg-white">
                                    @foreach(languages() as $key => $language)
                                        <li class="nav-item">
                                            <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link  {{$language->value == session('lang') ? 'active' : null}}">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                                <span class="d-none d-sm-block">{{$language->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                                <div class="tab-content pt-0">
                                        @foreach(languages() as $key => $language)
                                            <div class="tab-pane  {{$language->value == session('lang') ? 'active' : null}}" id="language-{{$language->value}}">
                                                <div class="card-box">
                                                    <div class="form-group">
                                                        <label for="name">{{__('lang.website_title')}} <span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="data[site.name.{{$language->value}}]" id="name" value="{{setting('site.name.'.$language->value)}}" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="company">{{__('lang.company_name')}}</label>
                                                        <input type="text" class="form-control" name="data[site.company.{{$language->value}}]" id="company" value="{{setting('site.company.'.$language->value)}}">
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <label for="slogan">{{__('lang.slogan')}}</label>
                                                        <input type="text" class="form-control" name="data[site.slogan.{{$language->value}}]" id="slogan" value="{{setting('site.slogan.'.$language->value)}}">
                                                    </div>
                                                </div>
                                                <div class="card-box">
                                                    <div class="form-group">
                                                        <label for="address">{{__('lang.address')}}</label>
                                                        <textarea name="data[contact.address.{{$language->value}}]" id="address" cols="30" rows="5" class="form-control">{{setting('contact.address.'.$language->value)}}</textarea>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label for="contact">{{__('lang.contact_details')}}</label>
                                                        <textarea class="form-control summerdescription" id="summercontact" name="data[contact.detail.{{$language->value}}]">{!! setting('contact.detail.'.$language->value) !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="card-box">
                                                    <label for="footer">{{__('lang.content_footer')}}</label>
                                                    <textarea class="form-control summerdescription" id="summernote" name="data[site.footer.{{$language->value}}]">{!! setting('site.footer.'.$language->value) !!}</textarea>
                                                </div>
                                                <div class="card-box">
                                                    <div class="d-flex mb-2">
                                                        <label class="font-weight-bold">{{__('lang.optimization')}} {{__('lang.seo')}}</label>
                                                        <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">{{__('lang.edit')}} {{__('lang.seo')}}</a>
                                                    </div>

                                                    <p class="font-13">{{__('lang.note_seo')}}</p>
                                                    <div class="test-seo">
                                                        <div class="mb-1">
                                                            <a href="javascript:void(0)"  class="title-seo" id="title_seo_{{$language->value}}">{{setting('site.name.'.$language->value)}}</a>
                                                        </div>
                                                        <div class="url-seo">
                                                            <span class="slug-seo" id="alias_seo">{{route('home')}}</span>
                                                        </div>

                                                        <div class="description-seo" id="description_seo_{{$language->value}}">{{setting('site.description_seo.'.$language->value)}}</div>
                                                    </div>

                                                    <div class="change-seo" id="change-seo">
                                                        <hr>
                                                        <div class="form-group">
                                                            <label>{{__('lang.description')}}</label>
                                                            <p class="font-13"><code>*</code> {{__('lang.max')}} 320 {{__('lang.characters')}} </p>
                                                            <textarea  class="form-control" rows="3" name="data[site.description_seo.{{$language->value}}]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)">{{setting('site.description_seo.'.$language->value)}}</textarea>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label>{{__('lang.keyword')}}</label>
                                                            <p class="font-13">{!! __('lang.note_keyword') !!}</p>

                                                            <input type="text" name="data[site.keyword_seo.{{$language->value}}]" value="{{setting('site.keyword_seo.'.$language->value)}}" class="form-control"  data-role="tagsinput"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box position-relative box-action-image">
                                    <label>Logo</label>
                                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.3rem">
                                        <label class="item-input">
                                            <input type="file" id="logo-upload" name="logo" class="d-none logo-upload" data-target="#site_logo_url"> {{__('lang.select_image')}}
                                        </label>
                                    </div>
                                    <p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
                                    <div class="dropzone p-2 text-center">
                                            <div class="dz-message text-center needsclick mb-1 {{!setting('site.logo') ? '' : 'd-none'}}" id="site_logo_hidden">
                                                <label for="logo-upload" class="w-100 mb-0">
                                                    <div class="icon-dropzone pt-2">
                                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                    </div>
                                                    <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span>
                                                </label>
                                            </div>

                                        <img src="{{setting('site.logo')}}" class="rounded mb-1 {{setting('site.logo') ? '' : 'd-none'}}" id="site_logo_src">

                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.logo]" placeholder="{{__('lang.slug')}}" id="site_logo_url" value="{{setting('site.logo')}}" class="form-control logo-src" data-target="#site_logo_src" data-hidden="#site_logo_hidden">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-box position-relative box-action-image">
                                    <label>og:image</label>
                                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.3rem">
                                        <label class="item-input">
                                            <input type="file" id="og-upload" name="logo" class="d-none og-upload" data-target="#site_og_url"> {{__('lang.select_image')}}
                                        </label>
                                    </div>
                                    <p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}</p>
                                    <div class="dropzone p-2 text-center">
                                        <div class="dz-message text-center needsclick mb-1 {{!setting('site.og_image') ? '' : 'd-none'}}" id="site_og_hidden">
                                            <label for="og-upload" class="w-100 mb-0">
                                                <div class="icon-dropzone pt-2">
                                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                </div>
                                                <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span>
                                            </label>
                                        </div>
                                        <img src="{{setting('site.og_image')}}" class="rounded mb-1 {{setting('site.og_image') ? '' : 'd-none'}}" id="site_og_src">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.og_image]" placeholder="{{__('lang.slug')}}" id="site_og_url" value="{{setting('site.og_image')}}" class="form-control og-src" data-target="#site_og_src" data-hidden="#site_og_hidden">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-box position-relative box-action-image">
                                    <label>Favicon</label>
                                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.3rem">
                                        <label class="item-input">
                                            <input type="file" id="favicon-upload" name="logo" class="d-none favicon-upload" data-target="#site_favicon_url"> {{__('lang.select_image')}}
                                        </label>
                                    </div>
                                    <p class="font-13"><code>*</code> {{__('lang.note_upload_image')}}  / {{__('lang.ratio')}} 1:1 / {{__('lang.size')}} 50x50 (px)</p>
                                    <div class="dropzone p-2 text-center">
                                        <div class="dz-message text-center needsclick mb-1 {{!setting('site.favicon') ? '' : 'd-none'}}" id="site_favicon_hidden">
                                            <label for="favicon-upload" class="w-100 mb-0">
                                                <div class="icon-dropzone pt-2">
                                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                </div>
                                                <span class="text-muted font-13">{!! __('lang.note_select_image') !!}</span>
                                            </label>
                                        </div>
                                        <img src="{{setting('site.favicon')}}" class="rounded mb-1 {{setting('site.favicon') ? '' : 'd-none'}}" id="site_favicon_src">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.favicon]" placeholder="{{__('lang.slug')}}" id="site_favicon_url" value="{{setting('site.favicon')}}" class="form-control favicon-src" data-target="#site_favicon_src" data-hidden="#site_favicon_hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset title="2" class="p-0">
                        <legend>{!! __('lang.contact_info') !!}</legend>

                        <div class="row mt-1">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.contact_info') !!}</label>
                                    <p>{!! __('lang.note_contact_info') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group">
                                        <label for="email">{!! __('lang.email') !!} <code class="required">{!! __('lang.note_email') !!}</code></label>
                                        <input type="text" class="form-control" id="email" value="{{setting('contact.email')}}" name="data[contact.email]">
                                    </div>
                                    <div class="form-group">
                                        <label for="hotline">{!! __('lang.hotline') !!}</label>
                                        <input type="tel" class="form-control" value="{{setting('contact.hotline')}}" id="hotline" name="data[contact.hotline]">
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone">{!! __('lang.phone') !!}</label>
                                        <input type="tel" class="form-control" id="phone" value="{{setting('contact.phone')}}" name="data[contact.phone]">
                                    </div>

                                    <div class="form-group">
                                        <label for="fax">{!! __('lang.fax') !!}</label>
                                        <input type="text" class="form-control" value="{{setting('contact.fax')}}" id="fax" name="data[contact.fax]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="time_open">{!! __('lang.time_open') !!}</label>
                                        <input type="text" class="form-control" value="{{setting('contact.time_open')}}" id="time_open" name="data[contact.time_open]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.google_map') !!}</label>
                                    <p>{!! __('lang.note_google_map') !!} <a href="https://www.google.com/maps/place/H%C3%A0+N%E1%BB%99i,+Ho%C3%A0n+Ki%E1%BA%BFm,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0227788,105.8194541,14z/data=!3m1!4b1!4m5!3m4!1s0x3135ab9bd9861ca1:0xe7887f7b72ca17a9!8m2!3d21.0277644!4d105.8341598?hl=vi-VN" target="_blank">{!! __('lang.learn_more') !!}.</a> </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="map">iFrame {!! __('lang.google_map') !!}</label>
                                        <textarea name="data[contact.map]" id="map" cols="30" rows="5" class="form-control">{!! setting('contact.map') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-primary">
                    </fieldset>
                    <fieldset title="3" class="p-0">
                        <legend>{!! __('lang.additional_code') !!}</legend>

                        <div class="row mt-1">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.pre_additional_code') !!}  <code> &lt;/head&gt; </code></label>
                                    <p>{!! __('lang.note_head') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="remarketing_header">{!! __('lang.additional_code') !!} <code> &lt;/head&gt; </code></label>
                                        <textarea class="form-control" rows="12" name="data[site.remarketing_header]">{!! setting('site.remarketing_header')!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.pre_additional_code') !!}  <code>  &lt;/body&gt;  </code></label>
                                    <p>{!! __('lang.note_body') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="remarketing_footer">{!! __('lang.additional_code') !!} <code>  &lt;/body&gt;  </code></label>
                                        <textarea class="form-control" rows="12" name="data[site.remarketing_footer]">{!! setting('site.remarketing_footer') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                    </fieldset>
                    <fieldset title="4" class="p-0">
                        <legend>Liên kết</legend>
                        <div class="row mt-1">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="facebook">Fanpage facebook</label>
                                    <p>{!! __('lang.note_facebook') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" value="{{setting('social.facebook')}}" id="facebook" name="data[social.facebook]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="youtube">Youtube channel</label>
                                    <p>{!! __('lang.note_youtube') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" class="form-control" value="{{setting('social.youtube')}}" id="youtube" name="data[social.youtube]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="zalo">Zalo</label>
                                    <p>{!! __('lang.note_zalo') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="zalo">Zalo</label>
                                        <input type="text" class="form-control" value="{{setting('social.zalo')}}" id="zalo" name="data[social.zalo]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="skype">Skype</label>
                                    <p>{!! __('lang.note_skype') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="skype">Skype</label>
                                        <input type="text" class="form-control" value="{{setting('social.skype')}}" id="skype" name="data[social.skype]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="twitter">Twitter</label>
                                    <p>{!! __('lang.note_twitter') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" value="{{setting('social.twitter')}}" id="twitter" name="data[social.twitter]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="instagram">Instagram</label>
                                    <p>{!! __('lang.note_instagram') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" value="{{setting('social.instagram')}}"  id="instagram" name="data[social.instagram]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="linkedin">Linkedin</label>
                                    <p>{!! __('lang.note_linkedin') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="linkedin">Linkedin</label>
                                        <input type="text" class="form-control" value="{{setting('social.linkedin')}}"  id="linkedin" name="data[social.linkedin]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="pinterest">Pinterest</label>
                                    <p>{!! __('lang.note_pinterest') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group mb-0">
                                        <label for="pinterest">Pinterest</label>
                                        <input type="text" class="form-control" value="{{setting('social.pinterest')}}"  id="pinterest" name="data[social.pinterest]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">

                    </fieldset>
                    <fieldset title="5" class="p-0">
                        <legend>API</legend>
                        <div class="mt-1">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card-box mb-0 bg-transparent">
                                        <label for="google_analytics_id">Google Analytics</label>
                                        <p>{!! __('lang.note_google_analytics') !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-box mb-0">
                                        <label for="google_analytics_id">Google Analytics ID</label>
                                        <input type="text" class="form-control" value="{{setting('api.google_analytics_id')}}" id="google_analytics_id" name="data[api.google_analytics_id]">
                                    </div>
                                </div>
                            </div>
                            <hr class="border-primary">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card-box mb-0 bg-transparent">
                                        <label for="imgur_client_id">Imgur</label>
                                        <p>{!! __('lang.note_imgur') !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-box mb-0">
                                        <label for="imgur_client_id">Imgur client ID <code>[ 6ac7b24eeb97e2f ]</code></label>
                                        <input type="text" class="form-control" value="{{setting('api.imgur_client_id')}}" id="facebook_app_secret" name="data[api.imgur_client_id]">
                                    </div>
                                </div>
                            </div>
                            <hr class="border-primary">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card-box mb-0 bg-transparent">
                                        <label for="imgur_client_id">Facebook App</label>
                                        <p>{!! __('lang.note_facebook_app') !!} <a href="https://developers.facebook.com/apps/" class="" target="_blank">{!! __('lang.learn_more') !!}</a> </p>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-box mb-0">
                                        <div class="form-group">
                                            <label for="facebook_app_ip">App ID  </label>
                                            <input type="text" class="form-control" value="{{setting('api.facebook_app_ip')}}" id="facebook_app_ip" name="data[api.facebook_app_ip]">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="facebook_app_secret">App Secret</label>
                                            <input type="text" class="form-control" value="{{setting('api.facebook_app_secret')}}" id="facebook_app_secret" name="data[api.facebook_app_secret]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-primary">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card-box mb-0 bg-transparent">
                                        <label for="imgur_client_id">Facebook Messages</label>
                                        <p>{!! __('lang.note_facebook_messages') !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-box mb-0">
                                        <div class="form-group">
                                            <label for="facebook_app_ip">App ID </label>
                                            <input type="text" class="form-control" value="{{setting('api.chat_message_id')}}" id="chat_message_id" name="data[api.chat_message_id]">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="chat_message_text">App ID messages</label>
                                            <input type="text" class="form-control" value="{{setting('api.chat_message_text')}}" id="chat_message_text" name="data[api.chat_message_text]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-primary">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card-box mb-0 bg-transparent">
                                        <label class="font-weight-semibold mb-4"> Google reCAPTCHA  <input type="checkbox" {{checked(setting('api.google_captcha'), true)}} data-plugin="switchery" data-color="#64b0f2" name="data[api.google_captcha]" data-size="small"/></label>
                                        <p>{!! __('lang.note_google_capcha') !!} <a href="https://www.google.com/recaptcha/lib/create" class="" target="_blank">{!! __('lang.learn_more') !!}</a></p>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-box mb-0">
                                        <div class="form-group">
                                            <label for="re_captcha_key">Site key  </label>
                                            <input type="text" class="form-control" value="{{setting('api.re_captcha_key')}}" id="re_captcha_key" name="data[api.re_captcha_key]">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="re_captcha_secret">Secret key</label>
                                            <input type="text" class="form-control" value="{{setting('api.re_captcha_secret')}}" id="re_captcha_secret" name="data[api.re_captcha_secret]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-primary">
                        </div>

                    </fieldset>
                    <fieldset title="6" class="p-0">
                        <legend>{!! __('lang.setting') !!}</legend>
                        @can('blog.view')
                        <div class="row mt-1">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.post') !!} <code> ({!! __('lang.post') !!}, {!! __('lang.page') !!}, ...) </code></label>
                                    <p>{!! __('lang.note_config_post') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <select class="form-control" name="data[site.post.size]">
                                            <option value="s" {{selected(setting('site.post.size'),'s')}}>90x90</option>
                                            <option value="t" {{selected(setting('site.post.size'),'t')}}>160x160</option>
                                            <option value="m" {{selected(setting('site.post.size'),'m')}}>320x320</option>
                                            <option value="l" {{selected(setting('site.post.size'),'l')}}>640x640</option>
                                            <option value="h" {{selected(setting('site.post.size'),'h')}}>1024x1024</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{!! __('lang.home') !!}</label>
                                        <input id="touchspin" type="text" value="{{setting('site.post.index')}}" name="data[site.post.index]">
                                    </div>
                                    <div class="form-group">
                                        <label>{!! __('lang.category') !!}</label>
                                        <input id="touchspin" type="text" value="{{setting('site.post.category')}}" name="data[site.post.category]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>{!! __('lang.post') !!} <span class="text-lowercase">{!! __('lang.related') !!}</span></label>
                                        <input id="touchspin" type="text" value="{{setting('site.post.related')}}" name="data[site.post.related]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                        @endcan

                        @canany(['product.view','video.view','gallery.view'])
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <label for="imgur_client_id">{!! __('lang.product') !!} <code> ({!! __('lang.product') !!}, {!! __('lang.gallery') !!}, {!! __('lang.video') !!},...) </code></label>
                                    <p>{!! __('lang.note_config_product') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <select class="form-control" name="data[site.product.size]">
                                            <option value="s" {{selected(setting('site.product.size'),'s')}}>90x90</option>
                                            <option value="t" {{selected(setting('site.product.size'),'t')}}>160x160</option>
                                            <option value="m" {{selected(setting('site.product.size'),'m')}}>320x320</option>
                                            <option value="l" {{selected(setting('site.product.size'),'l')}}>640x640</option>
                                            <option value="h" {{selected(setting('site.product.size'),'h')}}>1024x1024</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{!! __('lang.home') !!}</label>
                                        <input id="touchspin" type="text" value="{{setting('site.product.index')}}" name="data[site.product.index]">
                                    </div>
                                    <div class="form-group">
                                        <label>{!! __('lang.category') !!}</label>
                                        <input id="touchspin" type="text" value="{{setting('site.product.category')}}" name="data[site.product.category]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>{!! __('lang.post') !!} <span class="text-lowercase">{!! __('lang.related') !!}</span></label>
                                        <input id="touchspin" type="text" value="{{setting('site.product.related')}}" name="data[site.product.related]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                        @endcan

                        @can('setting.language')
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <input type="hidden" value="0" name="data[site.languages]">
                                    <label class="font-weight-semibold"> {!! __('lang.language') !!} <input type="checkbox" {{checked(setting('site.languages'),true)}} data-plugin="switchery" data-color="#64b0f2" name="data[site.languages]" data-size="small"/></label>
                                    <p class="mb-0">{!! __('lang.note_language') !!} <a href="{{route('admin.languages.index')}}">{!! __('lang.here') !!} </a> </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <label>{!! __('lang.list_language') !!}</label>
                                    @foreach(\App\Models\Language::oldest()->get() as $item)
                                        <blockquote class="blockquote mb-0">
                                            <footer class="blockquote-footer"><cite title="{{$item->name}} ({{$item->value}})" class="font-weight-bold">{{$item->name}} ({{$item->value}})</cite></footer>
                                        </blockquote>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                        @endcan
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="card-box mb-0 bg-transparent">
                                    <input type="hidden" value="0" name="data[site.maintenance]">
                                    <label class="font-weight-semibold"> {!! __('lang.maintenance') !!} <input type="checkbox" {{checked(setting('site.maintenance'),true)}} data-plugin="switchery" data-color="#64b0f2" name="data[site.maintenance]" data-size="small"/></label>
                                    <p>{!! __('lang.note_maintenance') !!} </p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-box mb-0">
                                    <div class="form-group">
                                        <label for="password">{{__('lang.password')}}  <code>{{__('lang.note_maintenance_password')}}</code></label>
                                        <input type="text" class="form-control" value="{{setting('site.password')}}" id="password" name="data[site.password]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="note_maintenance">{{__('lang.note')}}</label>
                                        <textarea type="text" class="form-control" id="note_maintenance" rows="4"  name="data[site.note.maintenance]">{{setting('site.note.maintenance')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                    </fieldset>
                    <button type="submit" class="btn btn-primary stepy-finish"><span class="icon-button"><i class="fe-send"></i></span> {{__('lang.save')}}</button>
                </div>

                <div class="">
                    <button type="reset" class="btn btn-default waves-effect waves-light"><span class="icon-button"><i class="fe-refresh-ccw"></i></span> {{__('lang.reset')}}</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><span class="icon-button"><i class="fe-plus"></i></span> {{__('lang.save')}}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End row -->
</div>

@stop

@section('scripts')
    <script src="{{asset('lib/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <!--Form Wizard-->
    <script src="{{asset('lib/assets/libs/stepy/jquery.stepy.js')}}"></script>

    <!-- Validation init js-->
    <script src="{{asset('lib/assets/js/pages/wizard.init.js')}}"></script>

    <script src="{{asset('lib/assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js')}}"></script>


@stop
