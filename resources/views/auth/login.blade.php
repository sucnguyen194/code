@extends('layouts.layout')
@section('title') Login @stop
@section('content')

    <section class="account-section ptb-80 bg-overlay-white bg_img" data-background="/client/images/frontend/breadcrumbs/60d7134ad0d271624707914.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="account-form-area">
                        @if(setting('site.logo'))
                        <div class="account-logo-area text-center">
                            <div class="account-logo">
                                <a href="/"><img src="{{setting('site.logo')}}" alt="logo"></a>
                            </div>
                        </div>
                        @endif
                        <div class="account-header text-center">
                            <h3 class="title">Sign in to ViserLance</h3>
                        </div>
                        <form class="account-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row ml-b-20">
                                <div class="col-lg-12 form-group">
                                    <label for="username">Email*</label>
                                    <input type="email" class="form-control form--control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control form--control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 form-group">
                                </div>


                                <div class="col-lg-12 form-group">
                                    <div class="forgot-item">
                                        <label><a href="{{ route('password.request') }}" class="text--base">Forgot Password?</a></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group text-center">
                                    <button type="submit" class="submit-btn w-100">Login Now</button>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div class="account-item mt-10">
                                        <label>Already Have An Account? <a href="{{ route('register') }}" class="text--base">Register Now</a></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
