@extends('layouts.layout')
@section('title') {{trans('lang.contact')}} @stop
@section('content')
    <main id="main-wrap">
        <div class="page-child-wrap contact-page">

            <div class="all">
                <div class="all1170">
                    <div class="page-title">
                        <h1 class="tt-txt">Liên hệ</h1>
                        <br><div class="breadcrumb">
                            <div class="container">
                                <ul class="breadcrumb-nav">
                                    <li><a href="/">Trang chủ</a></li>/
                                    <li class="a">Liên hệ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="contact-if-map">
                        {!! setting('contact.map') !!}
                    </div>
                    <div class="contact-info-box">
                        <h2 class="boxtt">{{setting('site.company', true)}}</h2>
                        <ul class="contact-info-ul">
                            <li><span class="prefix"><img loading="lazy" class="alignnone size-full wp-image-18" src="/client/uploads/2019/09/icon-map.png" alt="" width="24" height="24"></span>
                                <div class="text">
                                    {!! nl2br(setting('contact.address', true) )  !!}
                                </div>
                            </li>
                            <li><span class="prefix"><img loading="lazy" class="alignnone size-full wp-image-19" src="/client/uploads/2019/09/icon-phone.png" alt="" width="19" height="19"></span>
                                <div class="text">Hotline:&nbsp;<a class="hl-txt" style="box-sizing: border-box; padding: 0px; margin: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: Muli, sans-serif; vertical-align: baseline; color: #0d257b; text-decoration-line: none; text-align: center;" href="tel:{{setting('contact.hotline')}}">{{setting('contact.hotline')}}</a></div>
                            </li>
                            <li><span class="prefix"><img loading="lazy" class="alignnone size-full wp-image-14" src="/client/uploads/2019/09/icon-envelope.png" alt="" width="17" height="14"></span>
                                <div class="text">Email: <a href="mailto:info@lychee.biz.vn">{{setting('contact.email')}}</a></div>
                            </li>
                            <li><span class="prefix"><img loading="lazy" class="alignnone size-full wp-image-15" src="/client/uploads/2019/09/icon-facebook.png" alt="" width="13" height="24"></span>
                                <div class="text">facebook: <a href="{{setting('social.facebook')}}" target="_blank" rel="noopener noreferrer">{{setting('social.facebook')}}</a></div>
                            </li>
                            <li><span class="prefix"><img loading="lazy" class="alignnone size-full wp-image-17" src="/client/uploads/2019/09/icon-instagram.png" alt="" width="22" height="22"></span>
                                <div class="text">Instagram: {{setting('social.instagram')}}</div>
                            </li>
                        </ul>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
{{--<script src='https://www.google.com/recaptcha/api.js'></script>--}}
@stop
