<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset(setting('site.favicon'))}}">

    <!-- App css -->
    <link href="{{asset('lib/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
          id="bootstrap-stylesheet"/>
    <link href="{{asset('lib/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('lib/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="/lib/css/cpanel.css" rel="stylesheet" type="text/css">
</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

<div class="home-btn d-none d-sm-block">
    <a href="{{route('home')}}"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">
                    <div class="card-body p-4">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <div class="text-center">
                                    <a href="/">
                                        <img src="{{asset(setting('site.logo'))}}" alt="" height="30">
                                    </a>
                                </div>
                                <h5 class="text-uppercase mb-1 mt-4">Đăng nhập</h5>
                                <p class="mb-0">Đăng nhập bằng tài khoản Admin của bạn!</p>
                            </div>

                            <div class="account-content mt-4">
                                <form class="form-horizontal" action="{{route('admin.login')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="account">Email</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            @if (Route::has('password.request'))
                                                {{--                                                <a class="btn btn-link float-right text-muted" href="{{ route('password.request') }}">--}}
                                                {{--                                                    {{ trans('auth.Forgot Your Password?') }}--}}
                                                {{--                                                </a>--}}
                                            @endif

                                            <label for="password">{{trans('auth.Password')}}</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="checkbox">
                                                <input id="remember" type="checkbox" name="remember" checked="checked">
                                                <label for="remember" class="font-14">
                                                    {{trans('auth.Remember Me')}}
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row text-center mt-2">
                                        <div class="col-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light"
                                                    type="submit">{{trans('auth.Login')}}</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row pb-2">
                                    <div class="col-sm-12 text-center">
                                        <p class="text-secondary mb-0"> <a
                                                href="https://www.facebook.com/thietkewebsitegiare247194"
                                                target="_blank" class="text-secondary ml-1"><b>Hỗ trợ kỹ thuật</b></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            <a href="https://www.facebook.com/thietkewebsitegiare247194" target="_blank"
                                               class="btn mr-1 btn-facebook waves-effect waves-light">
                                                <i class="fab fa-facebook-f"></i>acebook
                                            </a>
                                            <a href="mailto:spaussio@gmail.com" target="_blank"
                                               class="btn mr-1 btn-googleplus waves-effect waves-light">
                                                <i class="fab fa-google"></i>oogle
                                            </a>
                                            {{--                                            <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">--}}
                                            {{--                                                <i class="fab fa-twitter"></i>--}}
                                            {{--                                            </button>--}}
                                        </div>
                                    </div>
                                </div>

                                {{--                                <div class="row pt-2">--}}
                                {{--                                    <div class="col-sm-12 text-center">--}}
                                {{--                                        <p class="text-muted mb-0">Hỗ trợ kỹ thuật <a href="https://www.facebook.com/thietkewebsitegiare247194" target="_blank" class="text-dark ml-1"><b>Facebook</b></a></p>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{asset('lib/assets/js/vendor.min.js')}}"></script>


<script src="{{asset('lib/js/cpanel.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<!-- toastr init js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!-- App js -->
<script src="{{asset('lib/assets/js/app.min.js')}}"></script>
@include('errors.note')
</body>
</html>
