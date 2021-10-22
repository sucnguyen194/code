@extends('admin.layouts.layout')
@section('title')
    Cấu hình hệ thống
@stop
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cấu hình hệ thống</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Cấu hình hệ thống</h4>
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

                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
                </div>
                @csrf
                <div id="wizard-clickable" >
                    <fieldset title="1">
                        <legend>Thông tin Website</legend>
                        <div class="row mt-1">
                            <div class="col-md-8">
                                @if(setting('site.languages'))
                                <ul class="nav nav-tabs tabs-bordered nav-justified pt-1 bg-white">
                                    @foreach(languages() as $key => $language)
                                        <li class="nav-item">
                                            <a href="#language-{{$language->value}}" data-toggle="tab" aria-expanded="false" class="nav-link  {{$key == 0 ? 'active' : null}}">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                                <span class="d-none d-sm-block">{{$language->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                                <div class="tab-content pt-0">

                                        @foreach(languages() as $key => $language)
                                            <div class="tab-pane  {{$key == 0 ? 'active' : null}}" id="language-{{$language->value}}">
                                                <div class="card-box">
                                                    <div class="form-group">
                                                        <label for="name">Tiêu đề website <span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="data[site.name.{{$language->value}}]" id="name" value="{{setting('site.name.'.$language->value)}}" language="title_seo_{{$language->value}}" onkeyup="changeToTitleSeo(this)">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="company">Tên đơn vị</label>
                                                        <input type="text" class="form-control" name="data[site.company.{{$language->value}}]" id="company" value="{{setting('site.company.'.$language->value)}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="slogan">Slogan</label>
                                                        <input type="text" class="form-control" name="data[site.slogan.{{$language->value}}]" id="slogan" value="{{setting('site.slogan.'.$language->value)}}">
                                                    </div>

{{--                                                    <div class="form-group mb-0">--}}
{{--                                                        <label for="path">Website</label>--}}
{{--                                                        <input type="text" class="form-control" placeholder="www.company.com" name="data[site.path]" id="path" value="{{setting('site.path.'.$language->value)}}">--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="card-box">
                                                    <div class="form-group">
                                                        <label for="address">Địa chỉ</label>
                                                        <textarea name="data[contact.address.{{$language->value}}]" id="address" cols="30" rows="5" class="form-control">{{setting('contact.address.'.$language->value)}}</textarea>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <label for="contact">Chi tiết liên hệ</label>
                                                        <textarea class="form-control summernote" id="summercontact" name="data[contact.detail.{{$language->value}}]">{!! setting('contact.detail.'.$language->value) !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="card-box">
                                                    <label for="footer">Nội dung chân trang</label>
                                                    <textarea class="form-control summernote" id="summernote" name="data[site.footer.{{$language->value}}]">{!! setting('site.footer.'.$language->value) !!}</textarea>
                                                </div>
                                                <div class="card-box">
                                                    <div class="d-flex mb-2">
                                                        <label class="font-weight-bold">Tối ưu SEO</label>
                                                        <a href="javascript:void(0)" onclick="changeSeo()" class="edit-seo">Chỉnh sửa SEO</a>
                                                    </div>

                                                    <p class="font-13">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy trang trên công cụ tìm kiếm như Google.</p>
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
                                                            <label>Mô tả trang</label>
                                                            <p class="font-13">* Giới hạn tối đa 320 ký tự</p>
                                                            <textarea  class="form-control" rows="3" name="data[site.description_seo.{{$language->value}}]" maxlength="320" id="alloptions" language="description_seo_{{$language->value}}" onkeyup="changeToDescriptionSeo(this)">{{setting('site.description_seo.'.$language->value)}}</textarea>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label>Từ khóa</label>
                                                            <p class="font-13">* Từ khóa được phân chia sau dấu phẩy <strong>","</strong></p>

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
                                            <input type="file" id="logo-upload" name="logo" class="d-none logo-upload" data-target="#site_logo_url"> Chọn ảnh
                                        </label>
                                    </div>
                                    <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif</p>
                                    <div class="dropzone p-2 text-center">
                                            <div class="dz-message text-center needsclick mb-1 {{!setting('site.logo') ? 'd-block' : 'd-none'}}" id="site_logo_hidden">
                                                <label for="logo-upload" class="w-100 mb-0">
                                                    <div class="icon-dropzone pt-2">
                                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                    </div>
                                                    <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span>
                                                </label>
                                            </div>

                                        <img src="{{setting('site.logo')}}" class="rounded mb-1 {{setting('site.logo') ? 'd-block' : 'd-none'}}" id="site_logo_src">

                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.logo]" placeholder="Đường dẫn ảnh" id="site_logo_url" value="{{setting('site.logo')}}" class="form-control logo-src" data-target="#site_logo_src" data-hidden="#site_logo_hidden">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-box position-relative box-action-image">
                                    <label>og:image</label>
                                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.3rem">
                                        <label class="item-input">
                                            <input type="file" id="og-upload" name="logo" class="d-none og-upload" data-target="#site_og_url"> Chọn ảnh
                                        </label>
                                    </div>
                                    <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif</p>
                                    <div class="dropzone p-2 text-center">
                                        <div class="dz-message text-center needsclick mb-1 {{!setting('site.og_image') ? 'd-block' : 'd-none'}}" id="site_og_hidden">
                                            <label for="og-upload" class="w-100 mb-0">
                                                <div class="icon-dropzone pt-2">
                                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                </div>
                                                <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span>
                                            </label>
                                        </div>
                                        <img src="{{setting('site.og_image')}}" class="rounded mb-1 {{setting('site.og_image') ? 'd-block' : 'd-none'}}" id="site_og_src">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.og_image]" placeholder="Đường dẫn ảnh" id="site_og_url" value="{{setting('site.og_image')}}" class="form-control og-src" data-target="#site_og_src" data-hidden="#site_og_hidden">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-box position-relative box-action-image">
                                    <label>Favicon</label>
                                    <div class="position-absolute font-weight-normal text-primary" id="box-input" style="right:1.5rem;top:1.3rem">
                                        <label class="item-input">
                                            <input type="file" id="favicon-upload" name="logo" class="d-none favicon-upload" data-target="#site_favicon_url"> Chọn ảnh
                                        </label>
                                    </div>
                                    <p class="font-13">* Định dạng ảnh jpg, jpeg, png, gif / Tỷ lệ 1:1 / Kích thước gợi ý 50x50 (px)</p>
                                    <div class="dropzone p-2 text-center">
                                        <div class="dz-message text-center needsclick mb-1 {{!setting('site.favicon') ? 'd-block' : 'd-none'}}" id="site_favicon_hidden">
                                            <label for="favicon-upload" class="w-100 mb-0">
                                                <div class="icon-dropzone pt-2">
                                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                </div>
                                                <span class="text-muted font-13">Sử dụng nút <strong>Chọn ảnh</strong> để thêm ảnh</span>
                                            </label>
                                        </div>
                                        <img src="{{setting('site.favicon')}}" class="rounded mb-1 {{setting('site.favicon') ? 'd-block' : 'd-none'}}" id="site_favicon_src">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span id="basic-addon1" class="input-group-text">src</span></div>
                                            <input type="text" name="data[site.favicon]" placeholder="Đường dẫn ảnh" id="site_favicon_url" value="{{setting('site.favicon')}}" class="form-control favicon-src" data-target="#site_favicon_src" data-hidden="#site_favicon_hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset title="2">
                        <legend>Thông tin liên hệ</legend>
                        <div class="card-box mt-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email <small class="required">(* Địa chỉ nhận email từ khách hàng)</small></label>
                                        <input type="text" class="form-control" id="email" value="{{setting('contact.email')}}" name="data[contact.email]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="phone">Điện thoại</label>
                                        <input type="text" class="form-control" id="phone" value="{{setting('contact.phone')}}" name="data[contact.phone]">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input type="text" class="form-control" value="{{setting('contact.hotline')}}" id="hotline" name="data[contact.hotline]">
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="fax">Fax</label>
                                        <input type="text" class="form-control" value="{{setting('contact.fax')}}" id="fax" name="data[contact.fax]">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numbercall">Action Call</label>
                                        <input type="text" class="form-control" value="{{setting('contact.numbercall')}}" id="numbercall" name="data[contact.numbercall]">
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="time_open">Thời gian mở cửa</label>
                                        <input type="text" class="form-control" value="{{setting('contact.time_open')}}" id="time_open" name="data[contact.time_open]">
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="map">iFrame Google Map</label>
                                <textarea name="data[contact.map]" id="map" cols="30" rows="5" class="form-control">{!! setting('contact.map') !!}</textarea>
                            </div>

                        </div>

                    </fieldset>
                    <fieldset title="3">
                        <legend>Mã bổ xung (Marketing...)</legend>
                        <div class="card-box mt-1">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="remarketing_header">Mã bổ xung phía trước &lt;/head&gt; </label>
                                        <textarea class="form-control" rows="12" name="data[site.remarketing_header]">{!! setting('site.remarketing_header')!!}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="remarketing_footer">Mã bổ xung phía trước &lt;/body&gt; </label>
                                        <textarea class="form-control" rows="12" name="data[site.remarketing_footer]">{!! setting('site.remarketing_footer') !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset title="4">
                        <legend>Liên kết</legend>
                        <div class="card-box  mt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" value="{{setting('social.facebook')}}" id="facebook" name="data[social.facebook]">
                                    </div>
                                    <div class="form-group">
                                        <label for="google">Google+</label>
                                        <input type="text" class="form-control" value="{{setting('social.google')}}" id="google" name="data[social.google]">
                                    </div>
                                    <div class="form-group">
                                        <label for="messenger">Messenger</label>
                                        <input type="text" class="form-control" value="{{setting('social.messenger')}}" id="messenger" name="data[social.messenger]">
                                    </div>
                                    <div class="form-group">
                                        <label for="youtube">Youtube</label>
                                        <input type="text" class="form-control" value="{{setting('social.youtube')}}" id="youtube" name="data[social.youtube]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="zalo">Zalo</label>
                                        <input type="text" class="form-control" value="{{setting('social.zalo')}}" id="zalo" name="data[social.zalo]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="skype">Skype</label>
                                        <input type="text" class="form-control" value="{{setting('social.skype')}}" id="skype" name="data[social.skype]">
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" value="{{setting('social.twitter')}}" id="twitter" name="data[social.twitter]">
                                    </div>
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" value="{{setting('social.instagram')}}"  id="instagram" name="data[social.instagram]">
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin">Linkedin</label>
                                        <input type="text" class="form-control" value="{{setting('social.linkedin')}}"  id="linkedin" name="data[social.linkedin]">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="pinterest">Pinterest</label>
                                        <input type="text" class="form-control" value="{{setting('social.pinterest')}}"  id="pinterest" name="data[social.pinterest]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset title="5" class="">
                        <legend>Cấu hình & API</legend>

                        <div class="bg-white">
                            <div class="card-body">

                                <label for="google_analytics_id">Google Analytics ID</label>
                                <input type="text" class="form-control" value="{{setting('api.google_analytics_id')}}" id="google_analytics_id" name="data[api.google_analytics_id]">
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <label for="facebook_app_secret">Imgur client ID</label>
                                <input type="text" class="form-control" value="{{setting('api.imgur_client_id')}}" id="facebook_app_secret" name="data[api.imgur_client_id]">
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <label class="font-weight-semibold mb-4">Facebook App</label>
                                <div class="form-group">
                                    <label for="facebook_app_ip">App ID <a href="https://developers.facebook.com/apps/" target="_blank">(FACEBOOK for Developers)</a> </label>
                                    <input type="text" class="form-control" value="{{setting('api.facebook_app_ip')}}" id="facebook_app_ip" name="data[api.facebook_app_ip]">
                                </div>
                                <div class="form-group mb-0">
                                    <label for="facebook_app_secret">App Secret</label>
                                    <input type="text" class="form-control" value="{{setting('api.facebook_app_secret')}}" id="facebook_app_secret" name="data[api.facebook_app_secret]">
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <label class="font-weight-semibold mb-4">Facebook Messages</label>
                                <div class="form-group">
                                    <label for="facebook_app_ip">App ID </label>
                                    <input type="text" class="form-control" value="{{setting('api.chat_message_id')}}" id="chat_message_id" name="data[api.chat_message_id]">
                                </div>
                                <div class="form-group mb-0">
                                    <label for="chat_message_text">App messages</label>
                                    <input type="text" class="form-control" value="{{setting('api.chat_message_text')}}" id="chat_message_text" name="data[api.chat_message_text]">
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <input type="hidden" value="0" name="data[api.google_captcha]">
                               <label class="font-weight-semibold mb-4"> Google reCAPTCHA  <input type="checkbox" {{checked(setting('api.google_captcha'), true)}} data-plugin="switchery" data-color="#64b0f2" name="data[api.google_captcha]" data-size="small"/></label>
                                <div class="form-group">
                                    <label for="re_captcha_key">reCAPTCHA site key <a href="https://www.google.com/recaptcha/lib/create" target="_blank">(Google reCAPTCHA)</a> </label>
                                    <input type="text" class="form-control" value="{{setting('api.re_captcha_key')}}" id="re_captcha_key" name="data[api.re_captcha_key]">
                                </div>
                                <div class="form-group mb-0">
                                    <label for="re_captcha_secret">reCAPTCHA secret key</label>
                                    <input type="text" class="form-control" value="{{setting('api.re_captcha_secret')}}" id="re_captcha_secret" name="data[api.re_captcha_secret]">
                                </div>
                            </div>

                            <hr class="border-light m-0">
                            <div class="card-body">
                                <input type="hidden" value="0" name="data[site.languages]">
                                <label class="font-weight-semibold"> Multilingual <input type="checkbox" {{checked(setting('site.languages'),true)}} data-plugin="switchery" data-color="#64b0f2" name="data[site.languages]" data-size="small"/></label>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" value="0" name="data[site.maintenance]">
                                    <label class="font-weight-semibold"> Bảo trì <input type="checkbox" {{checked(setting('site.maintenance'),true)}} data-plugin="switchery" data-color="#64b0f2" name="data[site.maintenance]" data-size="small"/></label>
                                </div>

                                <div class="form-group">
                                    <label for="password">Mật khẩu (mật khẩu để reivew khi website bảo trì)</label>
                                    <input type="text" class="form-control" value="{{setting('site.password')}}" id="password" name="data[site.password]">
                                </div>

                                <div class="form-group mb-0">
                                    <label for="note_maintenance">Ghi chú</label>
                                    <textarea type="text" class="form-control" id="note_maintenance" rows="4"  name="data[site.note.maintenance]">{{setting('site.note.maintenance')}}</textarea>
                                </div>

                            </div>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-primary stepy-finish"><span class="icon-button"><i class="fe-send"></i></span> Lưu lại</button>
                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right"><span class="icon-button"><i class="fe-plus"></i></span> Lưu lại</button>
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
