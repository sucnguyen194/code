@extends('layouts.layout')
@section('title') Đăng nhập @stop
@section('content')
    <main class="main-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image"> <img src="/frontend/images/bg-breadcrumb_1.jpg" alt="Breadcrumb"> </div>
                            <div class="title-box title-breadcrumb">
                                <h1 class="title">Đăng nhập</h1>
                                <h2 style="display: none" class="title">Đăng nhập</h2>
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
                                    <li> <span>Đăng nhập</span> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs-->
        <div class="page-site blogs-site">
            <div class="main-container">
                <article class="art-blogs">
                    <div class="container">
                        <div class="row">
                            <div class="offset-xl-3 offset-lg-3 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <form class="woocommerce-form woocommerce-form-login login" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Tên tài khoản hoặc địa chỉ email&nbsp;<span class="required">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu&nbsp;<span class="required">*</span></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="label">
                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <span>Ghi nhớ mật khẩu</span> </label>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary text-white" name="login" value="Đăng nhập">Đăng nhập</button>
                                    </div>
                                    <div class="text-right">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                Quên mật khẩu
                                            </a>
                                        @endif

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </article>
                <!-- art-blogs -->
            </div>
        </div>
    </main>
@endsection
