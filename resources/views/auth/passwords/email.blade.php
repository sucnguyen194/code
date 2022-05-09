@extends('layouts.layout')
@section('title') Reset password @stop
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
                            <h3 class="title">Reset password</h3>
                                <p>Forgot your password? Please enter your username or email address. You will receive a link to create a new password via email</p>
                        </div>

                        <form class="account-form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row ml-b-20">
                                <div class="col-lg-12 form-group">
                                    <label for="username">Email*</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 form-group text-center">
                                    <button type="submit" class="submit-btn w-100">Reset password</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
