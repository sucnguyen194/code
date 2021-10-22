@extends('layouts.layout')
@section('title') {{trans('lang.contact')}} @stop
@section('content')

<script src='https://www.google.com/recaptcha/api.js'></script>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->
<main class="main-site">
    <div class="art-breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="breadcrumbs-content">
                        <div class="image-box breadcrumb-image"> <img src="/frontend/images/bg-contacts-breadcrumb_1.jpg" alt="Breadcrumb"> </div>
                        <div class="title-box title-breadcrumb">
                            <h1 class="title">Liên hệ</h1>
                            <h2 style="display: none" class="title">Liên hệ</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="breadcrumbs-content">
                        <div class="content-box content-breadcrumb">
                            <ul class="breadcrumb-box mt-3">
                                <li> <a href="/" title="Trang chủ">Trang chủ</a> </li>
                                <li> <span>Liên hệ</span> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs-->
    <div class="page-site contacts-site">
        <div class="main-container">
            <article class="art-banners art-contacts">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="title-box title-banner title-contacts">
                                <h1 class="title"><span>Liên hệ với chúng tôi</span></h1>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="art-map">
                                <div class="map-box">
                                    {!! setting()->map !!}
                                </div>
                            </div>
                            <div class="address-box">
                                <ul>
                                    <li>
                                        <h4>{{setting()->company}}</h4>
                                    </li>
                                    <li> <i class="fas fa-map-marker-alt icon"></i> <span>{{setting()->address}}</span> </li>
                                    <li class="li">
                                        <div> <i class="fas fa-phone-alt icon"></i> <span>{{setting()->hotline}}</</span> </div>
                                        <div> <i class="fal fa-print icon"></i> <span>{{setting()->fax}}</</span> </div>
                                    </li>
                                    <li> <i class="fas fa-envelope icon"></i> <span>{{setting()->email}}</</span> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="contacts-box">
                                <div class="title-box title-contacts">
                                    <h3 class="title"><span>Gửi phản hồi cho chúng tôi</span></h3>
                                </div>
                                <div class="contacts-content">
                                    <form class="contacts-form" method="post" action="{{route('send.contact')}}">
                                        @csrf
                                        <div class="form-content">
                                            <div class="form-group">
                                                <!-- <i class="fas fa-user icon"></i> -->
                                                <input class="form-control" type="text" name="data[name]" required placeholder="Họ và tên">
                                                <span class="fr-error" id="error_name"></span> </div>
                                            <div class="form-group">
                                                <!-- <i class="fas fa-envelope icon"></i> -->
                                                <input class="form-control" type="email" name="data[email]" required placeholder="Email">
                                                <span class="fr-error" id="error_email"></span> </div>
                                            <div class="form-group">
                                                <!-- <i class="fas fa-phone-alt icon"></i> -->
                                                <input class="form-control" type="tel" name="data[phone]" required placeholder="Số điện thoại">
                                                <span class="fr-error" id="error_phone"></span> </div>
                                            <div class="form-group">
                                                <!-- <i class="fas fa-phone-alt icon"></i> -->
                                                <textarea class="form-control" type="text" name="data[note]" placeholder="Nội dung" rows="9"></textarea>
                                                <span class="fr-error" id="error_content"></span> </div>
                                            <div class="form-group">
                                                <div class="button">
                                                    <button class="btn btn-submit" type="submit">Gửi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </article>
        </div>
    </div>
</main>
<!-------------------------->
<!-----------SOURCSE----------->
<!-------------------------->

@stop
