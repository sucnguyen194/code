@extends('layouts.layout')
@section('title') Quên mật khẩu @stop
@section('content')
    <main class="main-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image"> <img src="/frontend/images/bg-breadcrumb_1.jpg" alt="Breadcrumb"> </div>
                            <div class="title-box title-breadcrumb">
                                <h1 class="title">Quên mật khẩu</h1>
                                <h2 style="display: none" class="title">Quên mật khẩu</h2>
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
                                    <li> <span>Quên mật khẩu</span> </li>
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
                                <form method="post" class="woocommerce-ResetPassword lost_reset_password" action="{{ route('password.email') }}">
                                    @csrf
                                    <p>Quên mật khẩu? Vui lòng nhập tên đăng nhập hoặc địa chỉ email. Bạn sẽ nhận được một liên kết tạo mật khẩu mới qua email.</p>
                                    <div class="form-group">
                                        <label for="user_login">Tên đăng nhập hoặc email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="clear"></div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary text-white" value="Đặt lại mật khẩu">Đặt lại mật khẩu</button>
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
