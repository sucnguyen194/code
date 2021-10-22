@extends('layouts.layout')
@section('title') Đăng ký @stop
@section('content')
    <main class="main-site">
        <div class="art-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="breadcrumbs-content">
                            <div class="image-box breadcrumb-image"> <img src="/frontend/images/bg-breadcrumb_1.jpg" alt="Breadcrumb"> </div>
                            <div class="title-box title-breadcrumb">
                                <h1 class="title">Đăng ký</h1>
                                <h2 style="display: none" class="title">Đăng ký</h2>
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
                                    <li> <span>Đăng ký</span> </li>
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
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Họ và tên</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Xác nhận mật khẩu</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4 text-right">
                                            <button type="submit" class="btn btn-primary text-white">
                                                Đăng ký
                                            </button>
                                        </div>
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
